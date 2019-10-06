<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendMessage(Request $request)
    {
        $conversation = Chat::conversations()->conversation->first();
        if ($request->mensagem) {
            $message = Chat::message($request->mensagem)
                ->from(Auth::user())
                ->to($conversation)
                ->send();
        }

        return response()->json();
    }

    public function getMessages()
    {
        $conversation = Chat::conversations()->conversation->first();
        $messages = $conversation->messages;
        foreach ($messages as &$message) {
            $message->user = User::find($message->user_id);
        }

        return response()->json(['mensagens' => $conversation->messages, 'usuarios_ativos' => $conversation->users]);
    }

    public function index()
    {
        $conversation = Chat::conversations()->conversation->first();

        if ($conversation) {
            $user = $conversation->users->where('id', Auth::user()->id)->first();
            if (!$user) {
                Chat::conversation($conversation)->addParticipants(Auth::user()->id);
                Chat::message('<Entrou no chat>')
                    ->from(Auth::user())
                    ->to($conversation)
                    ->send();
            }
        } else {
            $conversation = Chat::createConversation([Auth::user()->id]);
            Chat::message('<Entrou no chat>')
                ->from(Auth::user())
                ->to($conversation)
                ->send();
        }

        return view('chat')
            ->with(compact('conversation'));
    }
}
