<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::post('/register', [App\Http\Controllers\UserController::class, 'store']);

Route::middleware(['api'])->group(function (){
    Route::get('/user', [App\Http\Controllers\UserController::class, 'show']);
    Route::get('/index', [PostController::class, 'indexPost']);
    Route::post('/index', [PostController::class, 'storePost']);
    Route::delete('/index/{id}', [PostController::class, 'destroyPost']);

    Route::get('/comments/{id}', [CommentController::class, 'show']);
    Route::post('/comments', [CommentController::class, 'storeComment']);

    Route::post('/likes', [LikeController::class, 'toggleLike']);
});
