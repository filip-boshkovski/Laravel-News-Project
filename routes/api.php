<?php

use App\Http\Controllers\PostController;
use App\Http\Middleware\ValidateApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/test', function() {
//     return response()->json([
//         'firstName' => 'Nikola'
//     ]);
// });


Route::get('/posts', [PostController::class, 'apiGetPosts'])->middleware(ValidateApiKey::class);

Route::post('/post', [PostController::class, 'apiStorePost'])->middleware(ValidateApiKey::class);
