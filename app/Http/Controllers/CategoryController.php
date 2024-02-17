<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
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

        return response($categories, 200);
    }

    public function read($id) {
        $category = Category::findOrFail($id);

        return response($category, 200);
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
        $data['created_by'] = 'system';

        $category = Category::create($data);

        return response($category, 201);
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
            $category->created_by = 'system';
            $category->save();

            return response($category, 201);
        } else {
            $data['updated_by'] = 'system';
            $category->fill($data);

            $category->save();
            return response($category, 200);
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
        $data['updated_by'] = 'system';

        $category->fill($data);

        $category->save();
        return response($category, 200);
    }

    public function delete($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return response($category, 200);
    }
}
