@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register', 'autocomplete' => 'off']) !!}

<h2>新規ユーザー登録</h2>
{{ Form::label('ユーザー名') }}
{{ Form::text('username', '', ['class' => 'input', 'autocomplete' => 'off']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail', '', ['class' => 'input', 'autocomplete' => 'off']) }}

{{ Form::label('パスワード') }}
{{ Form::password('password', ['class' => 'input', 'autocomplete' => 'new-password']) }}

{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation', ['class' => 'input', 'autocomplete' => 'new-password']) }}

{{ Form::submit('新規登録') }}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<p class="guide"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
