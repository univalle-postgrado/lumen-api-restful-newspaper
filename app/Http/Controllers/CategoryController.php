<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index() {
        $categories = Category::select('id', 'title', 'alias', 'position')->orderBy('position', 'ASC')->get();

        return $this->validResponse($categories);
    }

    public function read($id) {
        $category = Category::findOrFail($id);

        return $this->validResponse($category);
    }

    public function create(Request $request) {
        $rules = [
            'title' => 'required|max:60|unique:categories',
            'position' => 'required|min:1|integer',
            'published' => 'required|boolean'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['alias'] = Str::slug($data['title']);
        $data['created_by'] = Auth::user()->email;

        $category = Category::create($data);

        return $this->successResponse($category, Response::HTTP_CREATED);
    }

    public function update($id, Request $request) {
        $rules = [
            'title' => 'required|max:60|unique:categories,title,' . $id,
            'position' => 'required|min:1|integer',
            'published' => 'required|boolean'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['alias'] = Str::slug($data['title']);

        $category = Category::find($id);

        if (empty($category)) {
            $category = new Category();
            
            $category->id = $id;
            $category->title = $data['title'];
            $category->alias = $data['alias'];
            $category->position = $data['position'];
            $category->published = $data['published'];
            $category->created_by = Auth::user()->email;
            $category->save();

            return $this->successResponse($category, Response::HTTP_CREATED);
        } else {
            $data['updated_by'] = Auth::user()->email;
            $category->fill($data);

            $category->save();
            return $this->successResponse($category, Response::HTTP_OK);
        }
    }

    public function patch($id, Request $request) {
        $rules = [
            'title' => 'max:60|unique:categories,title,' . $id,
            'position' => 'min:1|integer',
            'published' => 'boolean'
        ];
        $this->validate($request, $rules);

        $category = Category::findOrFail($id);

        $data = $request->all();
        if (isset($data['title'])) {
            $data['alias'] = Str::slug($data['title']);
        }
        $data['updated_by'] = Auth::user()->email;

        $category->fill($data);

        $category->save();
        return $this->successResponse($category, Response::HTTP_OK);
    }

    public function delete($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->successResponse($category, Response::HTTP_OK);
    }


    public function indexV2() {
        $categories = Category::select('id', 'title', 'alias', 'position', 'created_at')->orderBy('position', 'ASC')->get();

        return $this->validResponse($categories);
    }
}
