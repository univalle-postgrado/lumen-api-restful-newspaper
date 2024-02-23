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

    public function create(Request $request) {
        $rules = [
            'title' => 'required|max:60',
            'published' => 'required|boolean'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['alias'] = Str::slug($data['title']);
        $data['created_by'] = 'system';
        
        $content = Tag::create($data);

        return $this->successResponse($content, Response::HTTP_CREATED);
    }
}
