@extends('layouts.login')

@section('content')
<div class="container">
    <div class="profile">
        <img src="{{ asset($user->images) }}" alt="ユーザーアイコン">
        <h1>ユーザー名{{ $user->username }}</h1>
        <p>自己紹介{{ $user->bio }}</p>
        @if (auth()->user()->isFollowing($user->id))
                <form action="{{ route('unfollow', $user->id) }}" method="post">
                  @csrf
                  <button type="submit" class="">フォロー解除</button>
                </form>
              @else
                <form action="{{ route('follow', $user->id) }}" method="post">
                  @csrf
                  <button type="submit" class="">フォローする</button>
                </form>
              @endif
    </div>

    {{-- 投稿一覧 --}}
    <div class="posts">
        @foreach ($posts as $post)
        <div class="post">
            <img src="{{ asset($post->user->images) }}" alt="アイコン">
            <div class="list-post">
                <p>{{ $post->user->username }}</p>
                <p>{!! nl2br(e($post->post)) !!}</p>
            </div>
            <p>{{ $post->created_at->setTimezone('Asia/Tokyo')->format('Y-m-d H:i') }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
