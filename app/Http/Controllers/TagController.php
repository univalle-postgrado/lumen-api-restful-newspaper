<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class TagController extends Controller
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
        $contents = Tag::select('id', 'title', 'alias')->orderBy('title', 'ASC')->paginate(10);
        return $this->validResponse($contents);
    }

    public function read($id) {
        $tag = Tag::findOrFail($id);

        return $this->validResponse($tag);
    }

    public function create(Request $request) {
        $rules = [
            'title' => 'required|max:60|unique:tags',
            'published' => 'required|boolean'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['alias'] = Str::slug($data['title']);
        $data['created_by'] = 'system';
        
        $content = Tag::create($data);

        return $this->successResponse($content, Response::HTTP_CREATED);
    }

    public function update($id, Request $request) {
        $rules = [
            'title' => 'required|max:60|unique:tags,title,' . $id,
            'published' => 'required|boolean'
        ];
        $this->validate($request, $rules);

        $tag = Tag::findOrFail($id);

        $data = $request->all();
        $data['updated_by'] = 'system';
        $tag->fill($data);
        $tag->save();
        return $this->successResponse($tag, Response::HTTP_OK);
    }

    public function patch($id, Request $request) {
        $rules = [
            'title' => 'max:60|unique:tags,title,' . $id,
            'published' => 'boolean'
        ];
        $this->validate($request, $rules);

        $content = Tag::findOrFail($id);

        $data = $request->all();
        if (isset($data['title'])) {
            $data['alias'] = Str::slug($data['title']);
        }
        $data['updated_by'] = 'system';

        $content->fill($data);
        $content->save();
        return $this->successResponse($content, Response::HTTP_OK);
    }

    public function delete($id) {
        $tag = Tag::findOrFail($id);
        // Desasocia los tags antes de borrar el post
        $tag->contents()->detach();
        $tag->delete();
        return $this->successResponse($tag, Response::HTTP_OK);
    }
}
