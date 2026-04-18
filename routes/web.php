<?php

use App\Http\Controllers\Comments\CommentController;
use App\Http\Controllers\Blog\PostReadController;
use App\Http\Controllers\Creator\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CreatePost;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/dashboard', function () {
    if(Auth::user()->role == 'Creator'){
        return redirect()->route('posts.index');
    }

    if (Auth::user()->role == 'User') {
        return redirect()->route('blog.index');
    }

    return redirect()->route('filament.admin.pages.dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/blog', [PostReadController::class, 'index'])->name('blog.index');
Route::middleware('auth')->group(function () {
    Route::get('/blog/{post:slug}', [PostReadController::class, 'show'])->name('blog.show');

    // Profile Section
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Posts Section
    Route::get('/posts',[PostController::class,'index'])->name('posts.index');
    Route::middleware(CreatePost::class.':Creator')->group(function(){
        Route::post('/posts',[PostController::class,'store'])->name('posts.store');
        Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    });
    Route::get('/posts/{post:slug}',[PostController::class,'show'])->name('posts.show');
    Route::get('/posts/{post:slug}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

    // Comments Section
    Route::post('/comments',[CommentController::class,'store'])->name('comments.store');
});


require __DIR__.'/auth.php';
