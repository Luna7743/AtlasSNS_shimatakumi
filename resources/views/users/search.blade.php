@extends('layouts.login')

@section('content')
    <div class="search-container">
        {{-- 検索欄 --}}
        <form action="/search" method="get">
            @csrf
            <input type="text" name="search" class="search-form" placeholder="ユーザー名" value="{{ request('search') }}">
            <button type="submit" class="">
                <img src="{{ asset('images/search.png') }}" alt="検索">
            </button>
        </form>

        {{-- 検索結果がある場合、検索ワードを表示する --}}
        @if(isset($search))
          <p>検索ワード: {{$search}}</p>
        @endif

        {{-- ユーザー一覧 --}}
        <div class="user-list">
          @foreach ($users as $user)
            <div class="user-item">
              <img src="{{ asset($user->images) }}" alt="ユーザーアイコン">
              <p>{{ $user->username }}</p>
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
          @endforeach
        </div>

    </div>
@endsection
