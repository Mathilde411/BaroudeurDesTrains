<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{

    function display(Conversation $conversation)
    {
        return view('chat', ['conversation' => $conversation]);
    }

    function send(Request $request, Conversation $conversation)
    {
        $params = $request->validate([
            'message' => ['required', 'string'],
        ]);

        $user = Auth::user();

        return $conversation->sendMessage($user, $params['message']);
    }
}
