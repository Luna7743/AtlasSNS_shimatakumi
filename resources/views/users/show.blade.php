@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="main-form">
            <div class="show-main">
                <img src="{{ asset($user->images) }}" alt="ユーザーアイコン" class="user-icon-image">
                <div class="show-profile">
                    <dl>
                        <dt>ユーザー名</dt>
                        <dd>{{ $user->username }}</dd>
                        <dt>自己紹介</dt>
                        <dd>{{ $user->bio }}</dd>
                    </dl>
                </div>

                <div class="show-button">
                    @if (auth()->user()->isFollowing($user->id))
                        <form action="{{ route('unfollow', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="off">フォロー解除</button>
                        </form>
                    @else
                        <form action="{{ route('follow', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="on">フォローする</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- 投稿一覧 --}}
        <div class="post-list">
            <table class="table">
                @foreach ($posts as $post)
                    <tr>
                        <td class="list-post">
                            <div class="user-icon">
                                <img src="{{ asset($post->user->images) }}" alt="アイコン" class="user-icon-image">
                            </div>
                            <div class="user-post-list">
                                <p>{{ $post->user->username }}</p>
                                <p class="post-content">{!! nl2br(e($post->post)) !!}</p>
                            </div>
                        </td>

                        <td class="list-time">
                            <p class="time">{{ $post->created_at->setTimezone('Asia/Tokyo')->format('Y-m-d H:i') }}</p>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
