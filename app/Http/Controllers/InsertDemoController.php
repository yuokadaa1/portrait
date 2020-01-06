<?php

namespace App\Http\Controllers;

use App\Post;
use App\Modelid;
use App\Modelkbn;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InsertDemoController extends Controller{

  public function getIndex(){

    //postsの最大値をつけておく。※書き方が面倒なので直接SQLで記載。
    $modelids = DB::select("SELECT b.modelId,b.modelName,a.maxModelIdNum FROM modelids as b left outer join (SELECT modelId,MAX(modelIdNum) as maxModelIdNum FROM posts group by modelId) as a on b.modelId = a.modelId order by b.modelId");

    $modelkbns = Modelkbn::select('kbnId','kbnName')->orderBy('kbnId', 'asc')->get();

    return view('insert.index',compact('modelids','modelkbns'));
  }

  public function confirm(\App\Http\Requests\InsertDemoRequest $request){
    $data = $request->all();
    return view('insert.confirm')->with($data);
  }

  public function finish(\App\Http\Requests\InsertDemoRequest $request){

    $i = 0;
    foreach ($request->file()['input'] as $index) {
      //ファイルをサーバに格納
      // $file_name = $index->getClientOriginalName();
      $modelIdNum = Post::where('modelId',  $request->modelId)->max('modelIdNum') + 1;
      $file_name = "photo" . $request->modelId ."_". $modelIdNum . "." .$index->guessExtension() ;
      $folderPath = $index->storeAs('public',$file_name);
      //格納した位置情報などをDBに格納
      $post = new Post();
      $post->modelId = $request->modelId;
      $post->modelIdNum = $modelIdNum;
      $post->kbnid = $request->textarea[$i];
      $post->folderPath = $folderPath;
      $post->save();
      $i++;
    }

    return view('insert.finish');
  }

  public function idInsert(Request $request){

    $modelid = new Modelid();
    $modelid->modelId = Modelid::max('modelId') + 1;;
    $modelid->modelName = $request->modelName;
    $modelid->save();

    // return view('insert.index',compact('modelids','modelkbns'));
    return redirect('/request');
  }

  public function kbnInsert(Request $request){

    $modelkbn = new Modelkbn();
    $modelkbn->kbnId = Modelkbn::max('kbnId') + 1;
    $modelkbn->kbnName = $request->kbnName;
    $modelkbn->save();

    return redirect('/request');
  }

}
