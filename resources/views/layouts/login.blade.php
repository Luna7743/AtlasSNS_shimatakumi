<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <div id ="head">
            <h1>
                <a href="/top">
                    <img src="{{ asset('images/atlas.png') }}">
                </a>
            </h1>
            <p>{{ Auth::user()->username }} さん</p>
            <button type="button" class="menu-btn">
                <span class="inn"></span>
            </button>
            <nav class="nav-menu">
                <ul>
                    <li><a href="/top">HOME</a></li>
                    <li><a href="/profile">プロフィール編集</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="icon">
                @if (Auth::user()->images)
                    <img src="{{ Storage::url(Auth::user()->images) }}" alt="ユーザーのアイコン" class="user-icon-image">
                @else
                    <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン" class="user-icon-image">
                @endif

                {{-- {{ dd(Auth::user()->images) }} --}}
            </div>

        </div>
    </header>

    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }}さんの</p>
                <div class="follow">
                    <p class="follows">フォロー数</p>
                    <p>{{ Auth::user()->follows->count() }}人</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div class="follow">
                    <p class="followers">フォロワー数</p>
                    <p>{{ Auth::user()->followers->count() }}人</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="btn-user"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JavaScriptファイル -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
