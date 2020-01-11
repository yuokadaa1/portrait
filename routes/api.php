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

   //dBから情報を抽出して取得
  $Post = Post::select('modelId','modelIdNum','kbnId','folderPath','created_at')->orderBy('kbnId', 'asc')->orderBy('created_at', 'desc')->first()->toArray();

  $responseBody = array();
  foreach ($Post as & $value) {
    $httpResponse = array();
    $httpResponse['modelId'] = $value['modelId'];
    // $httpResponse['modelName'] = $value['modelName'];
    $httpResponse['modelIdNum'] = $value['modelIdNum'];
    $httpResponse['kbnId'] = $value['kbnId'];
    // $httpResponse['kbnName'] = $value['kbnName'];
    $httpResponse['images'] = file_get_contents(asset($value['folderPath']));
    array_push($responseBody,$httpResponse);
    $responseBody.push($httpResponse);
  }

  // 読み込み自体はできた->これでencodeされるのは画像のURL
  // $gazo = base64_encode(asset('images/ninja_woman_face1_smile.png'));

  //　これで「public\images\ninja_woman_face1_smile.png」を読み込む。
  // $gazo = base64_encode(file_get_contents(asset('images/ninja_woman_face1_smile.png')));

  //assetでの読み込み=public => public/storageにデータを格納、呼び出しが必要。
  // dd(base64_encode(file_get_contents(asset('storage/ninja_woman_face3_sad.png'))));

  $responseHeaders = [
   "X-Pages" => 1
  ];

  $statusCode = 200;

  return response()->json($responseBody, $statusCode, $responseHeaders,JSON_UNESCAPED_UNICODE);

 });
