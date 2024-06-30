<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class ChatController extends Controller
{
    public function getContacts() {
        $contacts = User::all();

        return response()->json($contacts);
    }

    public function sendMessage(Request $request) {
        Message::create([
            'to' => $request->to,
            'from' => $request->from,
            'message' => $request->message,
        ]);
    }

    public function getMessages($id) {
        $messages = Message::where('to', $id)
                    ->orWhere('from', $id)
                    ->get();
        
        return response()->json($messages);
    }
}
