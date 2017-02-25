<?php

namespace App\Http\Controllers;

use App\Message;

class MessageController extends Controller {

    public function index() {
        $messages = Message::whereUserId(auth()->user()->id)->get();
        return view('messages.index', compact('messages'));
    }
}
