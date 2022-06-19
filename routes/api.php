<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('posts',[\App\Http\Controllers\PostController::class,'index']);
Route::apiResource('posts',\App\Http\Controllers\PostController::class);
Route::apiResource('categories',\App\Http\Controllers\CategoryController::class);
Route::get('category/{slug}/posts',[\App\Http\Controllers\PostController::class,'categoryPosts']);
