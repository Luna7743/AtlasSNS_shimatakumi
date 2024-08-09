@extends('layouts.login')

@section('content')
    <div class="search-container">
        {{-- 検索欄 --}}
        <div class="main-form">
            <div class="main-search">
                <form action="/search" method="get">
                    @csrf
                    <input type="text" name="search" class="search-form" placeholder="ユーザー名" value="{{ request('search') }}">
                    <button type="submit" class="search-button">
                        <img src="{{ asset('images/search.png') }}" alt="検索" class="op-icon">
                    </button>
                </form>

                {{-- 検索結果がある場合、検索ワードを表示する --}}
                @if (isset($search))
                    <p>検索ワード: {{ $search }}</p>
                @endif
            </div>
        </div>

        {{-- ユーザー一覧 --}}
        <div class="user-list">
            @foreach ($users as $user)
                <div class="user-item">
                    <img src="{{ Storage::url($user->images) }}" alt="ユーザーのアイコン" class="user-icon-image">
                    <p>{{ $user->username }}</p>
                    <div class="user-follow">
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
            @endforeach
        </div>
    </div>
@endsection
