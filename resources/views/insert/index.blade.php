@extends('layouts.master_insert')
@section('title', 'Laravel チュートリアル（初級）')

@section('content')
<h3>従業員登録画面</h3>
<p><span class="label label-danger">入力画面</span> -> 確認画面 -> 完了画面</p>

<form action="{{ url('/request/finish') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
  @csrf

  <div class="container">
    <div class="form-group">
      <p class="text-center bg-info">注意：登録する写真の一番目はサムネイル。</p>
      <div class="form-inline">
        <label class="col-sm-3 control-label" for="username">モデル情報：</label>
        <input type="text" class="col-sm-2 form-control" name="modelId" placeholder="モデルID">
      </div>
    </div>
  </div>

  <div class="container">
    <div class="form-group">
      <div class="form-inline box" data-formno="0">
        <label class="col-sm-3 control-label" for="username">登録する写真：</label>
        <lavel class="no">1</lavel>
        <input type="text" name="textarea[0]" class="col-sm-1 form-control toiawase" placeholder="kbn">
        <input type="file" id="file" name="input[0]" class="col-sm-4 form-control namae">
        <a class="btn btn-primary addformbox">追加</a>
        <a class="btn btn-warning deletformbox">削除</a>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-center">
      <input type="submit" name="button1" value="送信" class="btn btn-success btn-wide" />
    </div>
  </div>

</form>

<!-- モデル情報の表示 -->
<form class="form-horizontal">

  <table class="table table-striped">
    <thead>
      <tr><th scope="col">モデルＩＤ</th><th scope="col">モデル名</th><th scope="col">写真数</th></tr>
     </thead>
     <tbody>
       @foreach ($modelids as $modelid)
        <tr>
          <td>{{ $modelid->modelId }}</td><td>{{ $modelid->modelName }}</td><td>{{ $modelid->maxModelIdNum }}</td>
        </tr>
       @endforeach
     </tbody>
   </table>

</form>

<!-- モデル情報の挿入 -->
<form action="{{ url('/request/id') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
  @csrf

  <div class="container">
    <div class="form-group">
      <div class="form-inline">
        <label class="col-sm-3 control-label" for="username">追加するモデル情報：</label>
        <input type="text" class="col-sm-4 form-control" name="modelName" placeholder="モデル名">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-center">
      <input type="submit" name="button1" value="送信" class="btn btn-success btn-wide" />
    </div>
  </div>

</form>

<!-- モデル区分の表示 -->
<form class="form-horizontal">

   <table class="table table-striped">
     <thead>
       <tr><th scope="col">区分ＩＤ</th><th scope="col">区分名</th></tr>
      </thead>
      <tbody>
        @foreach ($modelkbns as $modelkbn)
         <tr>
           <td>{{ $modelkbn->kbnId }}</td><td>{{ $modelkbn->kbnName }}</td>
         </tr>
        @endforeach
      </tbody>
    </table>

</form>

<!-- モデル区分の挿入 -->
<form action="{{ url('/request/kbn') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
  @csrf

  <div class="container">
    <div class="form-group">
      <div class="form-inline">
        <label class="col-sm-3 control-label" for="username">追加する区分情報：</label>
        <input type="text" class="col-sm-4 form-control" name="kbnName" placeholder="区分名">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-center">
      <input type="submit" name="button1" value="送信" class="btn btn-success btn-wide" />
    </div>
  </div>

</form>


@section('scripts')
    <script src="/js/starter-template.js"></script>
@endsection

@endsection
