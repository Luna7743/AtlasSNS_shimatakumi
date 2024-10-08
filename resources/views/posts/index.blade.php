@extends('layouts.login')

@section('content')
    <div class="post-container">
        <!-- 投稿フォーム -->
        <div class="main-form">

            <!-- ユーザーのアイコンを表示 -->
            <div class="user-icon">
                @if (is_null(Auth::user()->images) || Auth::user()->images === '' || Auth::user()->images === 'images/icon1.png')
                    <img class="user-icon-image" src="{{ asset('images/icon1.png') }}" alt="プロフィール画像">
                @else
                    <img class="user-icon-image" src="{{ asset(Storage::url(Auth::user()->images)) }}" alt="プロフィール更新画像">
                @endif
            </div>

            <form action="/postscreate" method="post" class="post-form-content">
                @csrf
                <div class="form-group">
                    <!-- 投稿内容の入力フィールド -->
                    <textarea name="post" id="" class="form-control" placeholder="投稿内容を入力してください"></textarea>
                    @error('post')
                        <span class="form-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <!-- 投稿ボタン -->
                    <button type="submit" class="post-button">
                        <img src="{{ asset('images/post.png') }}" alt="投稿" class="op-icon">
                    </button>
                </div>
            </form>
        </div>

        {{-- 投稿一覧 --}}
        <div class="post-list">
            <table class="table">
                @foreach ($posts as $post)
                    <tr>
                        <td class="list-post">
                            <div class="user-icon">
                                <img src="{{ asset(Storage::url($post->user->images)) }}" alt="ユーザーのアイコン" class="user-icon-image">
                            </div>
                            <div class="user-post-list">
                                <div class="login-name">{{ $post->user->username }}</div>
                                <div class="post-content">{!! nl2br(e($post->post)) !!}</div>
                            </div>
                        </td>

                        <td class="list-time">
                            <div class="time">{{ $post->created_at->setTimezone('Asia/Tokyo')->format('Y-m-d H:i') }}
                            </div>
                            @if ($post->user_id == Auth::id())
                                <div class="post-list-image">
                                    {{-- 更新 --}}
                                    <button type="button" class="js-modal-open" data-post="{{ $post->post }}"
                                        data-post_id="{{ $post->id }}">
                                        <img src="{{ asset('images/edit.png') }}" alt="編集" class="op-icon">
                                    </button>
                                    {{-- 削除 --}}
                                    <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete-button">
                                            <img src="{{ asset('images/trash.png') }}" alt="削除" class="op-icon">
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    {{-- モーダル --}}
    <div class="modal js-modal">
        <div class="modal__bg"></div>
        <div class="modal__content">
            <form id="updateForm" action="/post/update" method="post" class="modal-form">
                @csrf
                <textarea id="uppost" name="uppost" class="modal_post_content"></textarea>
                <input type="hidden" name="post_id" class="modal_post_id" value="">
                <button type="submit" class="modal-button">
                    <img src="{{ asset('images/edit.png') }}" alt="更新" class="op-icon">
                </button>
                <div id="errorMessages" style="color: red;"></div>
            </form>
        </div>
    </div>
@endsection
