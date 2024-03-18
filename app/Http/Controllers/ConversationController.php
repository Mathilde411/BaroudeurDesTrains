<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{

    function display(Conversation $conversation)
    {
        return view('chat', ['conversation' => $conversation]);
    }

    function send(Request $request, Conversation $conversation)
    {
        return 0;
    }
}
