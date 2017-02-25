<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Response;

class MessageController extends Controller {

    /**
     *
     * Shows the listing of messages.
     *
     * @return Response
     */
    public function index() {
        $messages = Message::findMyMessages();
        return view('messages.index', compact('messages'));
    }
}
