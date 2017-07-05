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

Route::get('/show',function(){

return view('show');
});

Route::get('/edit', function (){

return view('edit');
});

Route::get('/create',function(){
return view('create');

});
