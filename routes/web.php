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
//
Route::get('/', function () {
    return view('welcome');
});

Route::get("/read", function(){
 // Modelのクラスを指定
 return [
  // "posts" => \App\Post::all()
  "post" => \App\Post::where("id",">",1)->get()
 ];
});

// Route::get('/home', 'HomeController@index');
// Route::post('/home/upload', 'HomeController@upload');

Route::get('/request','InsertDemoController@getIndex');
Route::post('/request/confirm', 'InsertDemoController@confirm');
Route::post('/request/finish', 'InsertDemoController@finish');
Route::post('/request/id', 'InsertDemoController@idInsert');
Route::post('/request/kbn', 'InsertDemoController@kbnInsert');
