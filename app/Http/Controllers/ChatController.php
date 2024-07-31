<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function getContacts(Request $request) {
        $currentUserId = $request->user()->id;
        $contacts = User::where('id', '!=', $currentUserId)
                    ->get();

        return response()->json($contacts);
    }

    public function sendMessage(Request $request) {
        $currentUserId = $request->user()->id;

        $message = Message::create([
            'to' => $request->to,
            'from' => $currentUserId,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }

    public function getMessages(Request $request, $contactId) {
        $currentUserId = $request->user()->id;
    
        $messages = Message::where(function ($query) use ($currentUserId, $contactId) {
                $query->where('to', $contactId)
                      ->where('from', $currentUserId);
            })
            ->orWhere(function ($query) use ($currentUserId, $contactId) {
                $query->where('to', $currentUserId)
                      ->where('from', $contactId);
            })
            ->orderBy('created_at', 'asc') 
            ->get();
    
        return response()->json($messages);
    }
    
}
