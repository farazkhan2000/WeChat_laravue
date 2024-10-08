<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/contacts', [ChatController::class, 'getContacts']);
// Route::get('/messages/{id}', [ChatController::class, 'getMessages']);
// Route::post('/send-message', [ChatController::class, 'sendMessage']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/contacts', [ChatController::class, 'getContacts']);
    Route::get('/messages/{id}', [ChatController::class, 'getMessages']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
});