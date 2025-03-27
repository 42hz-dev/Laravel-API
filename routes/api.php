<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// get all posts, no need to authorized
Route::get('/all/posts', [PostController::class, 'getAllPosts']);
// get single post, no need to authorized
Route::get('/post/{post}', [PostController::class, 'getPost']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    /* BLOG API */
    // Add Post
    Route::post('/add/post', [PostController::class, 'addNewPost']);
    // Edit Post
    Route::put('/add/{post}/edit', [PostController::class, 'editPost']);

});


