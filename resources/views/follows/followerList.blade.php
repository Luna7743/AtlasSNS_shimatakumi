@extends('layouts.login')

@section('content')
<div class="container">
  <p>フォロワーリスト</p>

  <!-- フォロワーのユーザーアイコン一覧 -->
  <div class="user-icon">
    @foreach ($followers as $user)
      <a href="{{ route('users.show', $user->id) }}">
        <img src="{{ asset($user->images) }}" alt="アイコン">
      </a>
    @endforeach

    <!-- フォロワーの投稿一覧 -->
    <div class="post-list">
      @foreach ($posts as $post)
      <div class="post-item">
        <a href="{{ route('users.show', $post->user->id) }}">
          <img src="{{ asset($post->user->images) }}" alt="アイコン">
        </a>
      </div>
      <div class="list-post">
        <p>{{ $post->user->username }}</p>
        <p>{!! nl2br(e($post->post)) !!}</p>
    </div>
    <p>{{ $post->created_at->setTimezone('Asia/Tokyo')->format('Y-m-d H:i') }}</p>

      @endforeach
    </div>
  </div>
</div>
@endsection
