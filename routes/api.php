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

    Route::put('posts/{post}/comments/{comment}', 'CommentsController@update');
    Route::post('posts/{post}/comments', 'CommentsController@store');
    Route::get('posts/{post}/comments/{comment}', 'CommentsController@show');
    Route::delete('posts/{post}/comments/{comment}', 'CommentsController@destroy');
});

