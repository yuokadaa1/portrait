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
  $Post = Post::select('modelId','modelIdNum','kbnId','folderPath','created_at')->orderBy('kbnId', 'asc')->orderBy('created_at', 'desc')->get()->toarray();

  $responseBody = array();
  foreach ($Post as $value) {
    $httpResponse = array();
    $httpResponse['modelId'] = $value['modelId'];
    // $httpResponse['modelName'] = $value['modelName'];
    $httpResponse['modelIdNum'] = $value['modelIdNum'];
    $httpResponse['kbnId'] = $value['kbnId'];
    // $httpResponse['kbnName'] = $value['kbnName'];

    if (file_exists(asset($value['folderPath']))) {
    // if (file_exists("public\storage\photo1_2.png")) {
      // ファイルが存在したら、ファイル名を付けて存在していると表示
      $httpResponse['images'] = file_get_contents(asset($value['folderPath']));
      // public$httpResponse['images'] = file_get_contents("public\storage\photo1_2.png");
    }else {
      $httpResponse['images'] = "これはエラー" . asset($value['folderPath']);
      // $httpResponse['images'] = "これはエラー" . "public\storage\photo1_2.png";
    }

    array_push($responseBody,$httpResponse);
  }

  dd($responseBody);
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
