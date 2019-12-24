<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get("/data", function(){
//  return [
//   "message" => "hello world !!"
//  ];
// });

 Route::get("/data", function(){
  $responseHeaders = [
   "X-Pages" => 1
  ];
  $responseBody = [
   "person" => array(
    "性別" => "男性",
    "血液型" => "A型",
    "血液型" => "A型",
    "post" => \App\Post::where("id",">",1)->get()
   )
  ];
  $statusCode = 201;
  return response()->json($responseBody, $statusCode, $responseHeaders,JSON_UNESCAPED_UNICODE);

 });
