<?php

use Illuminate\Http\Request;
use App\Post;

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
  // $foderPath = Post::select('modelId','modelIdNum','folderPath','date')->get();
  // $foderPath = Post::select('modelId','modelIdNum','folderPath','date')->first();
  $folderPath = Post::select('folderPath')->first();
  // $gazo = base64_encode(file_get_contents($folderPath->folderPath));
  // $gazo = base64_encode(file_get_contents(asset('storage/app/images/ninja_woman_face1_smile.png')));

  // 読み込み自体はできた->これでencodeされるのは画像のURL
  // $gazo = base64_encode(asset('images/ninja_woman_face1_smile.png'));

  $gazo = base64_encode(file_get_contents(asset('images/ninja_woman_face1_smile.png')));

  // $folderPath->folderPath
  // storage\\app\\images\\ninja_woman_face1_smile.png
  $responseHeaders = [
   "X-Pages" => 1
  ];
  $responseBody = [
   "person" => array(
    "性別" => "男性",
    "血液型" => "A型",
    "血液型" => "A型",
    "画像" => $gazo
   )
  ];
  $statusCode = 200;
  return response()->json($responseBody, $statusCode, $responseHeaders,JSON_UNESCAPED_UNICODE);

 });
