<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Response;

class TagController extends Controller {

    /**
     * Shows a listing of posts by tag.
     *
     * @param Tag $tag
     * @return Response
     */
    public function index(Tag $tag) {
        return view('posts.index', compact('tag'));
    }

    /**
     * Loads a listing of posts by tags and page.
     *
     * @param Tag $tag
     * @return \Illuminate\Support\Collection
     */
    public function load(Tag $tag) {
        return $tag->loadPage(request('page', 0));
    }
}
