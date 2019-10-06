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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/chat/get_messages', 'ChatController@getMessages')->name('chat.messages');
Route::post('/chat/enviar', 'ChatController@sendMessage')->name('chat.send_message');
