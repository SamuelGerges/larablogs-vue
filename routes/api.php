<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('posts',PostController::class);
Route::get('category/{slug}/posts','PostController@showCourseByCategory');
Route::get('search-post/{query}','PostController@searchPosts');
Route::apiResource('categories',CategoryController::class);



Route::post('register',[\App\Http\Controllers\API\UserController::class,'register']);
Route::post('login',[\App\Http\Controllers\API\UserController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user-details',[\App\Http\Controllers\API\UserController::class,'getDetails']);
    Route::post('create-comment',[\App\Http\Controllers\API\CommentController::class,'store']);
});

Route::group(['prefix'=>'/admin','middleware'=>'auth:sanctum'],function(){
    Route::get('posts',[\App\Http\Controllers\API\AdminController::class,'getPosts']);
    Route::get('categories',[\App\Http\Controllers\API\AdminController::class,'getCategories']);
    Route::post('addPost',[\App\Http\Controllers\API\AdminController::class,'addPost']);
    Route::post('updatePost',[\App\Http\Controllers\API\AdminController::class,'updatePost']);
    Route::post('deletePosts',[\App\Http\Controllers\API\AdminController::class,'deletePosts']);
});