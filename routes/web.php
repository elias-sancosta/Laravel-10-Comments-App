<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', 'dashboard');

Route::get('/dashboard', function () {
    $comments = \App\Models\Comment::with('user','replies.user')
        ->orderBy('id', 'desc')
        ->paginate();
    
    return view('dashboard', ['comments' => $comments]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');
    
Route::post('replies/{comment}', [ReplyController::class, 'store'])
    ->name('replies.store')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';