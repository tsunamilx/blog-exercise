<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class PostController extends Controller {

    /**
     * Display a listing of posts.
     *
     * @return Response
     */
    public function index() {
        return view('posts.index');
    }

    /**
     * Loads a listing of posts by page.
     *
     * @return Response|Collection
     */
    public function load() {
        return Post::loadPage(request('page', 0));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return Response
     */
    public function create() {
        // Adding an empty post just to be compatible with the form
        // that is also used for edition.
        return view('posts.create', ['post' => new Post()]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param PostRequest $request
     * @return Response
     */
    public function store(PostRequest $request) {
        $post = new Post();
        $this->save($request, $post);

        return redirect()->route('posts_show', ['post' => $post->id]);
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post) {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return Response
     */
    public function update(PostRequest $request, Post $post) {
        $this->authorize('update', $post);
        $this->save($request, $post);

        return redirect()->route('posts_show', ['post' => $post->id]);
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  Post $post
     * @return mixed
     */
    public function destroy(Post $post) {
        $this->authorize('delete', $post);
        $post->delete();

        return $post;
    }

    /**
     * Create or update the post.
     *
     * @param PostRequest $request
     * @param Post $post
     */
    private function save(PostRequest $request, Post $post) {
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->save();

        if ($request->tags) {
            $tags = Tag::findOrCreate($request->tags);
            $post->tags()->sync($tags);
        }
    }
}
