<?php

namespace App\Http\Controllers;

use App\Post;
use App\Modelid;
use App\Modelkbn;
use Illuminate\Support\Facades\DB;

class InsertDemoController extends Controller{

  public function getIndex(){

    //postsの最大値をつけておく。※書き方が面倒なので直接SQLで記載。
    $modelids = DB::select("SELECT b.modelId,b.modelName,a.maxModelIdNum FROM modelids as b left outer join (SELECT modelId,MAX(modelIdNum) as maxModelIdNum FROM posts group by modelId) as a on b.modelId = a.modelId ");

    $modelkbns = Modelkbn::select('kbnId','kbnName')->orderBy('created_at', 'desc')->get();

    return view('insert.index',compact('modelids','modelkbns'));
  }

  public function confirm(\App\Http\Requests\InsertDemoRequest $request){
    $data = $request->all();
    return view('insert.confirm')->with($data);
  }

  public function finish(\App\Http\Requests\InsertDemoRequest $request){
    // $user = new \App\Worker;
    // $user->username = $request->username;
    // $user->mail = $request->mail;
    // $user->age = $request->age;
    // $user->save();

    return view('insert.finish');
  }
}
