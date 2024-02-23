<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Traits\ApiResponser;

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
}
