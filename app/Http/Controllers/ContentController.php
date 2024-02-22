<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Traits\ApiResponser;

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

}
