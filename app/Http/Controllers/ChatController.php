<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChatController extends Controller
{
    public function getContacts() {
        $contacts = User::all();

        return response()->json($contacts);
    }
}
