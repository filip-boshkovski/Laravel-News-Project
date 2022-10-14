<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{id}', [HomeController::class, 'byCategory']);

// front page post
Route::get('/post/{id}', [PostController::class, 'singlePost'])->name('post');

// comments
Route::post('/post/{id}/comment', [CommentController::class, 'store']);
// this is with route model binding
Route::get('/comment/{comment}', [CommentController::class, 'edit']);
Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
Route::put('/comment/{id}', [CommentController::class, 'update']);


// admin panel
Route::get('/admin', function() {
    return view('dashboard');
});

// categories
Route::get('/admin/categories', [CategoryController::class, 'index']);
Route::post('/admin/category', [CategoryController::class, 'store']);

Route::get('/admin/tags', [TagController::class, 'index']);
Route::post('/admin/tags', [TagController::class, 'store']);

// admin post
Route::get('/admin/posts', [PostController::class, 'index']);
Route::get('/admin/post/{id}', [PostController::class, 'show']);
