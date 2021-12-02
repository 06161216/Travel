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
    Route::get('/posts', 'SearchController@index');
});
Route::get('/video', 'PostController@video');

Route::get('/upload/image', 'ImageController@input');
//画像ファイルをアップロードする処理のルーティング
Route::post('/upload/image', 'ImageController@upload');
//アップロードした画像ファイルを表示するページのルーティング
Route::get('/output/image', 'ImageController@output');