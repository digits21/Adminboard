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
Route::get('admin-template',function(){
    
    return view('admin-template');
    
});

Route::resource('projects','projectsController');

Route::get('/create_project','createProjectController@index');

Route::get('/edit_project',function(){
    
    return view('edit_project');
});

Route::get('/admin_dashboard','ViewController@dashboard');
Route::get('/user_dashboard','ViewController@dashboard');
Route::resource('/participate','ParticipantController');
Route::get('profile','ViewController@profile');

