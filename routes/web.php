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

Route::get('/','userController@index');

Route::resource('user','userController');

Route::get('/show','ViewController@show');

Route::get('/edit','ViewController@edit');

Route::get('/create','ViewController@create');

Auth::routes();

Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');
Route::get('/chat', 'ChatsController@index');
Route::get('/edit_report',function()
           {
              return view('edit_report'); 
           });
Route::resource('post','postController');
Route::get('/user_reports','ReportController@index');

Route::resource('admin','adminController');
Route::get('/adminview',function(){
    
    return view('adminview');
});

