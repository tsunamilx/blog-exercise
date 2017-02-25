<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Message;
use App\Post;

class CommentController extends Controller {

    /**
     * Adds the comment to the post.
     *
     * @param CommentRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(CommentRequest $request, Post $post) {
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $post->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        $this->addMessage('added', $post);

        return redirect()->route('posts_show', ['post' => $post->id]);
    }

    /**
     * Updates the comment.
     *
     * @param CommentRequest $request
     * @param Comment $comment
     * @return Comment
     */
    public function update(CommentRequest $request, Comment $comment) {
        $comment->body = $request->body;
        $comment->save();

        $this->addMessage('updated', $comment->post);

        return $comment;
    }

    /**
     * Deletes the comment.
     *
     * @param $id
     */
    public function delete($id) {
        Comment::destroy($id);
    }

    /**
     * Adds the message "who added/updated comment to your post".
     *
     * @param $action
     * @param Post $post
     */
    private function addMessage($action, Post $post) {
        $message = new Message();

        $who = auth()->user()->name;
        $message->body = "{$who} {$action} comment to your post {$post->title}.";
        $message->user_id = $post->user_id;
        $message->from_user_id = auth()->user()->id;

        $message->save();
    }
}
