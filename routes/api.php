<?php

use Illuminate\Http\Request;

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
Route::get('/all', 'CommentController@index');
Route::get('/{id?}', 'CommentController@show');
Route::post('/add', 'CommentController@store');
Route::post('/edit/{id?}', 'CommentController@update');
Route::post('/delete/{id?}', 'CommentController@delete');
