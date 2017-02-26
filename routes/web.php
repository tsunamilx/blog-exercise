<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home.
Route::get('/', function () {
    return redirect()->route('posts_index');
})->name('home');

// All needed auth.
Route::group(['middleware' => 'auth'], function () {
    // Posts.
    Route::get('/posts/create', 'PostController@create')->name('posts_create');
    Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts_edit');
    Route::post('/posts', 'PostController@store')->name('posts_store');
    Route::put('/posts/{post}', 'PostController@update')->name('posts_update');
    Route::delete('/posts/{post}', 'PostController@destroy')->name('posts_destroy');

    // Comments.
    Route::post('/posts/{post}/comments', 'CommentController@add')->name('comments_add');
    Route::put('/comments/{comment}', 'CommentController@update')->name('comments_update');
    Route::delete('/comments/{comment}', 'CommentController@delete')->name('comments_delete');

    // Messages.
    Route::get('/messages', 'MessageController@index')->name('messages_index');

    // Users.
    Route::get('/users/{user}/edit', 'UserController@edit')->name('users_edit');
    Route::put('/users/{user}', 'UserController@update')->name('users_update');
    Route::delete('/users/{user}', 'UserController@destroy')->name('users_destroy');

});

// Posts.
Route::get('/posts', 'PostController@index')->name('posts_index');
Route::get('/posts/load', 'PostController@load')->name('posts_load');
Route::get('/posts/{post}', 'PostController@show')->name('posts_show');

// Tags.
Route::get('/tags/{tag}', 'TagController@index')->name('tags_index');
Route::get('/tags/{tag}/load', 'TagController@load')->name('tags_load');

// Users.
Route::get('/users/{user}', 'UserController@show')->name('users_show');

    // Auth.
Auth::routes();
