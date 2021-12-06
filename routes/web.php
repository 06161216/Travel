<?php

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

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'PostController@index');
    Route::get('/posts/create', 'PostController@create');
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::put('/posts/{post}', 'PostController@update');
    Route::delete('/posts/{post}', 'PostController@destroy');
    Route::get('/posts/{post}', 'PostController@show');
    Route::post('/posts', 'PostController@store');

    Route::get('/search', 'SearchController@index');

    Route::get('/video', 'PostController@video');

    Route::post('/reaction', 'ReactionController@input');
    // Route::post('/reaction', 'ReactionController@requestTravel');

    Route::get('/myPage', 'ReactionController@show');
    Route::post('/permission', 'ReactionController@match');

});