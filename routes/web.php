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
    Route::post('/posts', 'PostController@store');
    Route::get('/search', 'SearchController@index');
    Route::get('/video', 'PostController@video');
    Route::get('/myPage', 'ReactionController@show');
        Route::group(['middleware' => ['can:traveler']], function () {
            //トラベラーのみ
            Route::post('/reaction', 'ReactionController@input');
            //
        });
        Route::group(['middleware' => ['can:supplier']], function () {
            //サプライヤーのみ
            Route::get('/posts/create', 'PostController@create');
            Route::get('/posts/{post}/edit', 'PostController@edit');
            Route::put('/posts/{post}', 'PostController@update');
            Route::delete('/posts/{post}', 'PostController@destroy');
            Route::post('/permission', 'ReactionController@match');
            //
        });
    Route::get('/posts/{post}', 'PostController@show');

    // Route::get('/chat_select', 'ChatController@select');

    Route::get('/chat/{recieve}' , 'ChatController@index');
    
    // Route::get('/chat/{recieve}', function () {
    //   //return view('welcome');
    // //   return view('app');
    //   return view('pusher-index');
    // });
    
    Route::post('/chat/send' , 'ChatController@store');
// Route::group(['prefix' => '/pusher'], function () {
//     Route::get('/index', function () {
//         return view('pusher-index');
//     });
//     // 追加
//     Route::get('/hello-world', function () {
//         event(new App\Events\MyEvent('hello world'));
//         return ['message' => 'send to message : hello world'];
//     });
// });
});