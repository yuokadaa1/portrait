<?php

use Illuminate\Http\Request;
use App\Post;
use App\Modelid;
use App\Modelkbn;

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

  //理由は不明だが、apiの時はasset()を使うと読み込めない？下で実験したときはできたんだがなぁ？
  $responseBody = array();
  foreach ($Post as $value) {
    $httpResponse = array();
    $httpResponse['modelId'] = $value['modelId'];
    // $httpResponse['modelName'] = $value['modelName'];
    $httpResponse['modelIdNum'] = $value['modelIdNum'];
    $httpResponse['kbnId'] = $value['kbnId'];
    // $httpResponse['kbnName'] = $value['kbnName'];

    if (file_exists($value['folderPath'])) {
      $httpResponse['images'] = file_get_contents($value['folderPath']);
    }else {
      $httpResponse['images'] = "FILE_GET_ERR：" . $value['folderPath'];
    }

    array_push($responseBody,$httpResponse);
  }

  // 読み込み自体はできた->これでencodeされるのは画像のURL
  // $gazo = base64_encode(asset('images/ninja_woman_face1_smile.png'));

  //　これで「public\images\ninja_woman_face1_smile.png」を読み込む。
  // $gazo = base64_encode(file_get_contents(asset('images/ninja_woman_face1_smile.png')));

  //assetでの読み込み=public => public/storageにデータを格納、呼び出しが必要。
  // dd(base64_encode(file_get_contents(asset('storage/ninja_woman_face3_sad.png'))));

  $responseHeaders = ["X-Pages" => 1];
  $statusCode = 200;
  return response()->json($responseBody, $statusCode, $responseHeaders,JSON_UNESCAPED_UNICODE);

 });


Route::get("/thumbnail", function(){

  //getで来たときは直近30件分のサムネイルを返す。
  $Post = DB::select("SELECT a.modelId,b.maxNum,a.kbnId,a.folderPath,a.date,a.created_at FROM posts as a left outer join (
      Select modelId,max(modelIdNum) as maxNum,date from posts group by modelId,date) as b on a.modelId = b.modelId and a.date = b.date where a.thumbnailFlg is true order by a.created_at limit 30");
  // dd($Post);
  $i = 0;
  $responseBody = array();
  foreach ($Post as $value) {
    $httpResponse = array();
    $httpResponse['modelId'] = $value->modelId;
    // $httpResponse['modelName'] = $value['modelName'];
    $httpResponse['maxNum'] = $value->maxNum;
    $httpResponse['kbnId'] = $value->kbnId;
    // $httpResponse['kbnName'] = $value['kbnName'];
    $httpResponse['date'] = $value->date;
    if (file_exists($value->folderPath)) {
      $httpResponse['images'] = file_get_contents($value->folderPath);
    }else {
      $httpResponse['images'] = "FILE_GET_ERR";
    }
    // １：このNo.をつけないと連想配列=>連想配列でなく、配列=>連想配列になっちゃう
    $responseBody["No." . $i] = $httpResponse;
    // array_push($responseBody,$httpResponse);
    $i++;
  }

  $responseHeaders = ["X-Pages" => 1];
  $statusCode = 200;
  return response()->json($responseBody, $statusCode, $responseHeaders,JSON_UNESCAPED_UNICODE);

});

Route::post("/thumbnail", function(){
  //postで来たときはpost内容を見て抽出条件を確認

  // こんなんでとれる模様。
  // $post->title = request()->get("title");
  $Post = Post::select('modelId','modelIdNum','kbnId','folderPath','created_at')->where('thumbnailFlg',true)->orderBy('created_at', 'desc')->get()->toarray();

  $responseBody = array();
  foreach ($Post as $value) {
    $httpResponse = array();
    $httpResponse['modelId'] = $value['modelId'];
    // $httpResponse['modelName'] = $value['modelName'];
    $httpResponse['modelIdNum'] = $value['modelIdNum'];
    $httpResponse['kbnId'] = $value['kbnId'];
    // $httpResponse['kbnName'] = $value['kbnName'];
    if (file_exists($value['folderPath'])) {
      $httpResponse['images'] = file_get_contents($value['folderPath']);
    }else {
      $httpResponse['images'] = "FILE_GET_ERR";
    }
    array_push($responseBody,$httpResponse);
  }

});

//modelidの更新有無の取得
Route::get("/update/modelid", function(){
  $responseBody = Modelid::max('updated_at');
  $responseHeaders = ["X-Pages" => 1];
  $statusCode = 200;
  return response()->json($responseBody, $statusCode, $responseHeaders,JSON_UNESCAPED_UNICODE);
});

//modelkbnの更新有無の取得
Route::get("/update/modelkbn", function(){
  $responseBody = Modelkbn::max('updated_at');
  $responseHeaders = ["X-Pages" => 1];
  $statusCode = 200;
  return response()->json($responseBody, $statusCode, $responseHeaders,JSON_UNESCAPED_UNICODE);
});

//modelid更新用に全件再取得
Route::get("/modelid", function(){
  $responseBody = Modelid::select('modelId','modelName','updated_at')->get();
  $responseHeaders = ["X-Pages" => 1];
  $statusCode = 200;
  return response()->json($responseBody, $statusCode, $responseHeaders,JSON_UNESCAPED_UNICODE);
});

//modelkbn更新用に全件再取得
Route::get("/modelkbn", function(){
  $responseBody = Modelkbn::select('kbnId','kbnName','updated_at')->get();
  $responseHeaders = ["X-Pages" => 1];
  $statusCode = 200;
  return response()->json($responseBody, $statusCode, $responseHeaders,JSON_UNESCAPED_UNICODE);
});
