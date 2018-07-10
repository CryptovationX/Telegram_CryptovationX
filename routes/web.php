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

Route::get('/test', "TelegramController@test");
Route::any('/getuser', "TelegramUserController@test");

Route::any('/webhooks', "TelegramController@receive");

//TelegramBoardcast
Route::post('/success', "TelegramBoardcastController@boardcast")->name('boardcast.success');
Route::get('/boardcast', "TelegramBoardcastController@index");
Route::get('/tb', "TelegramBoardcastController@test");

//TelegramAutoReply
Route::post('/save', "TelegramAutoReplyController@store");
Route::get('/autoreply', "TelegramAutoReplyController@index");
Route::get('/ta', "TelegramAutoReplyController@test");
