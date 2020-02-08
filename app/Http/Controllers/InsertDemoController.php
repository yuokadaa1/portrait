<?php

namespace App\Http\Controllers;

use App\Post;
use App\Modelid;
use App\Modelkbn;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InsertDemoController extends Controller{

  // /requestの初期呼び出し画面
  public function getIndex(){

    //postsの最大値をつけておく。※書き方が面倒なので直接SQLで記載。
    $modelids = DB::select("SELECT b.modelId,b.modelName,a.maxModelIdNum FROM modelids as b left outer join (SELECT modelId,MAX(modelIdNum) as maxModelIdNum FROM posts group by modelId) as a on b.modelId = a.modelId order by b.modelId");

    // $modelkbns = Modelkbn::select('kbnId','kbnName')->orderBy('kbnId', 'asc')->get();

    // return view('insert.index',compact('modelids','modelkbns'));
    return view('insert.index',compact('modelids'));
  }

  public function confirm(\App\Http\Requests\InsertDemoRequest $request){
    $data = $request->all();
    return view('insert.confirm')->with($data);
  }

  public function finish(\App\Http\Requests\InsertDemoRequest $request){

    $i = 0;
    $saveDate = date("Y年m月d日　H時i分s秒");
    $modelInsertNum = Post::where('modelId',  $request->modelId)->max('modelInsertNum') + 1;

    foreach ($request->file()['input'] as $index) {
      //ファイルをサーバに格納
      // $file_name = $index->getClientOriginalName();
      $modelIdNum = Post::where('modelId',  $request->modelId)->max('modelIdNum') + 1;
      $file_name = "photo" . $request->modelId ."_". $modelIdNum . "." .$index->guessExtension() ;
      // stores は stringにしか使えない（base64はNGの）模様
      // $folderPath = $index->storeAs('public',$file_name);

      $image = base64_encode(file_get_contents($index->getRealPath()));

      //サーバーネームを見て、Herokuだったらレンタルサーバーに保存
      if($_SERVER['SERVER_NAME'] == "portrait531.herokuapp.com"){
        Storage::disk("sftp")->put($file_name,$image);
      }else{
        //これで書き込まれるものは「storage\app\」配下
        // Storage::disk("local")->put("public/" . $file_name,$image);
        Storage::disk("public")->put($file_name,$image);
        // $folderPath = "storage/app/public/" . $file_name;
      }

      $folderPath = "storage/" . $file_name;
      //格納した位置情報などをDBに格納
      $post = new Post();
      $post->modelId = $request->modelId;
      $post->modelIdNum = $modelIdNum;
      $post->modelInsertNum = $modelInsertNum;
      // $post->kbnid = $request->textarea[$i];
      $post->folderPath = $folderPath;
      if($i == 0)$post->thumbnailFlg = true ;
      $post->date = $saveDate;
      $post->save();
      $i++;
    }

    return view('insert.finish');
  }


//モデルIDの登録・・・だが、廃止
  public function idInsert(Request $request){

    $modelid = new Modelid();
    $modelid->modelId = Modelid::max('modelId') + 1;;
    $modelid->modelName = $request->modelName;
    $modelid->save();

    // return view('insert.index',compact('modelids','modelkbns'));
    return redirect('/request');
  }

//写真区分の登録・・・だが、廃止
  public function kbnInsert(Request $request){

    $modelkbn = new Modelkbn();
    $modelkbn->kbnId = Modelkbn::max('kbnId') + 1;
    $modelkbn->kbnName = $request->kbnName;
    $modelkbn->save();

    return redirect('/request');
  }

}
