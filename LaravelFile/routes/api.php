<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::get('/index', [PostController::class, 'indexPost']);
Route::post('/index', [PostController::class, 'storePost']);
Route::delete('/index/{id}', [PostController::class, 'destroyPost']);

Route::post('/spots', [CommentController::class, 'storeComment']);

Route::post('/likes', [LikeController::class, 'storeLike']);
Route::delete('/likes/{post_id}', [LikeController::class, 'destroyLike']);