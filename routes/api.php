<?php

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


Route::namespace('Api')->group(function () {
    Route::resource('posts', 'PostsController');
    Route::resource('posts/{post}/comments', 'CommentsController');

//    Route::get('posts', 'PostController@index')->name('posts.index');
//    Route::get('posts/{post}', 'PostController@show')->name('posts.show');
//    Route::put('posts/{post}', 'PostController@update')->name('posts.update');
//    Route::delete('posts/{post}', 'PostController@delete')->name('posts.delete');
});

