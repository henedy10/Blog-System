<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::controller(PostController::class)->group(function(){
    Route::name('posts.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/posts/create','create')->name('create');
        Route::post('/posts','store')->name('store');
        Route::put('/posts/{post}','update')->name('update');
        Route::get('/posts/{post}/edit','edit')->name('edit');
        Route::get('/posts/{post}','show')->name('show');
        Route::delete('/posts/{post}','destroy')->name('destroy');
    });
});
