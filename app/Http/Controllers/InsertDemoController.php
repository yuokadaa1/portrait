<?php

namespace App\Http\Controllers;
use App\Post;

class InsertDemoController extends Controller
{
  public function getIndex(){
    $posts = Post::orderBy('created_at', 'desc')->paginate(5);;
    // return view('insert.index')
    return view('insert.index',compact('posts'));;
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
