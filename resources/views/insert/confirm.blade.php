@extends('layouts.master_insert')
@section('title', 'Laravel チュートリアル（初級）')

@section('content')
  <h3>従業員登録画面</h3>
  <p>入力画面 -> <span class="label label-danger">確認画面</span> -> 完了画面</p>

<form action="{{ route('insert.finish') }}" method="post" class="form-horizontal">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="username" value="{{$username}}">
  <input type="hidden" name="mail" value="{{$mail}}">
  <input type="hidden" name="age" value="{{$age}}">

  <div class="row">
  <label class="col-sm-2 control-label" for="username">名前：</label>
  <div class="col-sm-10">{{$username}}</div>
  </div>
  <div class="row">
  <label class="col-sm-2 control-label" for="mail">Email：</label>
  <div class="col-sm-10">{{$mail}}</div>
  </div>
  <div class="row">
  <label class="col-sm-2 control-label" for="age">年齢：</label>
  <div class="col-sm-2">{{$age}}</div>
  <div class="col-sm-8">歳</div>
  </div>
  <div class="row">
  <div class="col-sm-offset-2 col-sm-10">
  <input type="submit" name="button1" value="登録" class="btn btn-primary btn-wide" />
  </div>
  </div>
</form>
@endsection
