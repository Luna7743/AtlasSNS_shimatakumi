@extends('layouts.login')

@section('content')
    {{-- {{ dd($user) }} --}}
    <div class="profile-content">
        {{-- プロフィール編集フォーム --}}
        <div class="pro-form">
            <form action="/profile/update" method="post" enctype="multipart/form-data">
                @csrf

                {{-- 現在のアイコンを表示 --}}
                <div class="icon-image">
                    @if ($user->images === null)
                        <img class="user-icon-image" src="{{ asset('images/icon.png') }}" alt="プロフィール画像">
                    @else
                        <img class="user-icon-image" src="{{ Storage::url($user->images) }}" alt="プロフィール更新画像">
                    @endif
                </div>

                <div class="profile-user">
                    <div class="profile-form-group">
                        <label for="username">ユーザー名</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username', $user->username) }}" required>
                    </div>
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="profile-form-group">
                        <label for="mail">メールアドレス</label>
                        <input type="mail" name="mail" id="mail" class="form-control"
                            value="{{ old('mail', $user->mail) }}" required>
                    </div>
                    @error('mail')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="profile-form-group">
                        <label for="password">パスワード</label>
                        <input type="password" name="password" id="password" class="form-control"
                            autocomplete="new-password">
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="profile-form-group">
                        <label for="password_confirmation">パスワード確認</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                            autocomplete="new-password">
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="profile-form-group">
                        <label for="bio">自己紹介</label>
                        <textarea name="bio" id="bio" class="profile-form-control" maxlength="150">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                    @error('bio')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="profile-form-group">
                        <label for="image">アイコン画像</label>
                        <div>
                            <label for="file_upload" class="upload">
                                <span class="file_upload_pick">ファイルを選択</span>
                                <input type="file" name="image" id="file_upload" class="form-control-file">
                                <span id="file_name" class="file-name"></span>
                            </label>
                        </div>
                    </div>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="btn-update">更新</button>
                </div>
            </form>
        </div>
    </div>
@endsection
