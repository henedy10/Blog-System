<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(PostApiController::class)->group(function(){
    Route::get('/','index');
    Route::post('/posts','store');
    Route::put('/posts/{post}','update');
    Route::get('/posts/{post}','show');
    Route::delete('/posts/{post}','destroy');
});
