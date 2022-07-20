<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
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
Route::get('searchposts/{query}',[\App\Http\Controllers\PostController::class,'searchPosts']);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::middleware('auth:api')->group( function () {
    Route::get('user',[UserController::class,'details']);
    Route::post('comment/create',[CommentController::class,'store']);
});


Route::group(['prefix' => '/admin','middleware' => 'auth:api'],function(){

    Route::get('posts',[AdminController::class,'getPosts']);
    Route::get('categories',[AdminController::class,'getCategories']);
    Route::post('addPost',[AdminController::class,'addPost']);

});

