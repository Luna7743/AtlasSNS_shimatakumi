@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="welcome">
    <p><span>{{ session('username') }}</span>さん</p>
    <p>ようこそ！AtlasSNSへ！</p>
  </div>
  <div class="comp">
    <ul class="comp-list">
      <li>ユーザー登録が完了いたしました。</li>
      <li>早速ログインをしてみましょう！</li>
    </ul>
  </div>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
