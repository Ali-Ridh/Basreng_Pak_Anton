<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AttachmentController;

Route::get('/', function () {
    return view('welcome');
});

// Forums routes
Route::resource('forums', ForumController::class);

// Nested threads routes
Route::resource('forums.threads', ThreadController::class);

// Nested posts routes
Route::resource('forums.threads.posts', PostController::class);

// Attachment routes
Route::get('attachments/{attachment}/download', [AttachmentController::class, 'download'])->name('attachments.download');
Route::get('attachments/{attachment}', [AttachmentController::class, 'show'])->name('attachments.show');

// Hidden Easter egg route
Route::get('/konami', function () {
    return response()->json([
        'message' => '🎮 Konami Code Activated! 🎮',
        'secret' => 'You found the hidden Easter egg! Up, Up, Down, Down, Left, Right, Left, Right, B, A, Start!',
        'reward' => '🏆 Master Gamer Badge Unlocked! 🏆'
    ]);
})->name('easter-egg');
