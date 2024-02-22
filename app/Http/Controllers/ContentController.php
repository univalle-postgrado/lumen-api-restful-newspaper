<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ContentController extends Controller
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
        $contents = Content::select('id', 'title', 'alias', 'image_url', 'introduction', 'category_title')->orderBy('created_at', 'DESC')->paginate(10);
        return $this->validResponse($contents);
    }

    public function read($id) {
        $content = Content::findOrFail($id);
        return $this->validResponse($content);
    }

    public function create(Request $request) {
        $rules = [
            'pretitle' => 'required|max:180',
            'title' => 'required|max:180',
            'author' => 'required|max:60',
            'image_url' => 'required|max:255',
            'introduction' => 'required|max:300',
            'body' => 'required',
            'tags' => 'required|max:300',
            'format' => 'required|in:ONLY_TEXT,WITH_IMAGE,WITH_GALLERY,WITH_VIDEO',
            'featured' => 'required|boolean',
            'status' => 'required|in:WRITING,PUBLISHED,NOT_PUBLISHED,ARCHIVED',
            'edition_date' => 'required|integer|min:1',
            'category_title' => 'required|max:60',
            'category_alias' => 'required|max:60'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['alias'] = Str::slug($data['title']);
        $data['created_by'] = 'system';

        $content = Content::create($data);

        return $this->successResponse($content, Response::HTTP_CREATED);
    }

    public function update($id, Request $request) {
        $rules = [
            'pretitle' => 'required|max:180',
            'title' => 'required|max:180',
            'author' => 'required|max:60',
            'image_url' => 'required|max:255',
            'introduction' => 'required|max:300',
            'body' => 'required',
            'tags' => 'required|max:300',
            'format' => 'required|in:ONLY_TEXT,WITH_IMAGE,WITH_GALLERY,WITH_VIDEO',
            'featured' => 'required|boolean',
            'status' => 'required|in:WRITING,PUBLISHED,NOT_PUBLISHED,ARCHIVED',
            'edition_date' => 'required|integer|min:1',
            'category_title' => 'required|max:60',
            'category_alias' => 'required|max:60'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['alias'] = Str::slug($data['title']);
        $data['updated_by'] = 'system';

        $content = Content::find($id);
        $content->fill($data);
        $content->save();
        return $this->successResponse($content, Response::HTTP_OK);
    }

    public function patch($id, Request $request) {
        $rules = [
            'pretitle' => 'max:180',
            'title' => 'max:180',
            'author' => 'max:60',
            'image_url' => 'max:255',
            'introduction' => 'max:300',
            'tags' => 'max:300',
            'format' => 'in:ONLY_TEXT,WITH_IMAGE,WITH_GALLERY,WITH_VIDEO',
            'featured' => 'boolean',
            'status' => 'in:WRITING,PUBLISHED,NOT_PUBLISHED,ARCHIVED',
            'edition_date' => 'integer|min:1',
            'category_title' => 'max:60',
            'category_alias' => 'max:60'
        ];
        $this->validate($request, $rules);

        $content = Content::findOrFail($id);

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
        $content = Content::findOrFail($id);
        $content->delete();
        return $this->successResponse($content, Response::HTTP_OK);
    }
}
