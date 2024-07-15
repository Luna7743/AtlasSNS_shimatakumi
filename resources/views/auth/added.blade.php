@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="welcome">
    <p>{{ session('username') }} さん</p>
    <p>ようこそ！AtlasSNSへ！</p>
  </div>
  <div class="comp">
    <p>ユーザー登録が完了いたしました。</p>
    <p>早速ログインをしてみましょう！</p>
  </div>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
