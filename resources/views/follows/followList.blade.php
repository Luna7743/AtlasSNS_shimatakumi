@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="user-icon">
            <!-- フォローしているユーザーのアイコン一覧 -->
            <div class="main-form">
                <p>フォローリスト</p>
                <div class="icon-list">
                    @foreach ($followingUsers as $user)
                        <a href="{{ route('users.show', $user->id) }}">
                            <img src="{{ asset(Storage::url($user->images)) }}" alt="ユーザーのアイコン" class="user-icon-image">
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- フォローしているユーザーの投稿一覧 -->
            <div class="post-list">
                <table class="table">
                    @foreach ($posts as $post)
                        <tr>
                            <td class="list-post">
                                <div class="user-icon">
                                    <a href="{{ route('users.show', $post->user->id) }}">
                                        <img src="{{ asset(Storage::url($post->user->images)) }}" alt="ユーザーのアイコン" class="user-icon-image">
                                    </a>
                                </div>
                                <div class="user-post-list">
                                    <p>{{ $post->user->username }}</p>
                                    <p class="post-content">{!! nl2br(e($post->post)) !!}</p>
                                </div>
                            </td>

                            <td class="list-time">
                                <p class="time">{{ $post->created_at->setTimezone('Asia/Tokyo')->format('Y-m-d H:i') }}
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
