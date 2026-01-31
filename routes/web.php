<?php

use App\Http\Controllers\Comments\CommentController;
use App\Http\Controllers\Creator\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    if(Auth::user()->role == 'Creator'){
        return redirect()->route('posts.index');
    }

    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Section
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Posts Section
    Route::get('/posts',[PostController::class,'index'])->name('posts.index');
    Route::post('/posts',[PostController::class,'store'])->name('posts.store');
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    Route::get('/posts/{post:slug}',[PostController::class,'show'])->name('posts.show');
    Route::get('/posts/{post:slug}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

    // Comments Section
    Route::post('/comments',[CommentController::class,'store'])->name('comments.store');
});


require __DIR__.'/auth.php';
