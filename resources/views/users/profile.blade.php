@extends('layouts.login')

@section('content')
{{-- {{ dd($user) }} --}}
<div class="profile-content">
  {{-- プロフィール編集フォーム --}}
  <div class="pro-form">
    <form action="/profile/update" method="post" enctype="multipart/form-data">
      @csrf

      {{-- 現在のアイコンを表示 --}}
      <div class="">
        @if ($user->images === null)
          <img class="" src="{{ asset('storage/') }}" alt="プロフィール画像">
        @else
          <img class="" src="{{ Storage::url($user->images)}}" alt="プロフィール更新画像">
        @endif
      </div>

      <div class="form-group">
        <label for="username">ユーザー名</label>
        <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        @error('username')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="mail">メールアドレス</label>
        <input type="mail" name="mail" id="mail" class="form-control" value="{{ old('mail', $user->mail) }}" required>
        @error('mail')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">パスワード確認</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
        @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="bio">自己紹介</label>
        <textarea name="bio" id="bio" class="form-control">
          {{ old('bio', $user->bio) }}
        </textarea>
        @error('bio')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="image">アイコン画像</label>
        <input type="file" name="image" id="image" class="form-control-file">
        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>



      <button type="submit" class="btn">更新</button>
    </form>
  </div>

</div>

@endsection
