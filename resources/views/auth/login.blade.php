@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}

<p class="sub-text">AtlasSNSへようこそ</p>

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('パスワード') }}
{{ Form::password('password',['class' => 'input', 'autocomplete' => 'new-password']) }}

{{ Form::submit('ログイン') }}

<p class="guide"><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
