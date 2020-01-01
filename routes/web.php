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

# 入力画面
Route::get('request/', [
  'uses' => 'InsertDemoController@getIndex',
  'as' => 'insert.index'
]);

# 確認画面
Route::post('request/confirm', [
  'uses' => 'InsertDemoController@confirm',
  'as' => 'insert.confirm'
]);

# 完了画面
Route::post('insert/finish', [
  'uses' => 'InsertDemoController@finish',
  'as' => 'insert.finish'
]);
