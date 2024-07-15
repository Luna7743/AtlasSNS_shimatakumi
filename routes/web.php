<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');//Atlasロゴにトップページへのリンクにもなる

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@search');

// Route::get('/follow-list','FollowsController@followList');
// Route::get('/follower-list','FollowsController@followerList');

//新規ユーザー登録
Route::get('/register','Auth\RegisterController@register');

//ログイン処理
Route::get('/login','Auth\LoginController@login');

//ミドルウェアを適応したいルートの設定を行います。(ログイン中のみ表示できる)
Route::middleware('Auth')->group(function () {
    Route::get('/top', 'PostsController@index')->name('top');
    Route::get('/profile','UsersController@profile')->name('profile.edit');
    Route::get('/user/search', 'UserController@search')->name('user.search');
    Route::get('/follow-list', 'FollowsController@followList')->name('follow.list');
    Route::get('/follower-list', 'FollowsController@followerList')->name('follower.list');
    Route::get('/user/{id}/profile', 'UserController@profile')->name('user.profile');
    // 投稿フォーム
    Route::post('/postscreate', 'PostsController@store');
    Route::post('/post/update', 'PostsController@update');
    Route::delete('/post/{id}', 'PostsController@destroy')->name('post.destroy');

    //フォロー / フォロワー数
    // Route::get('/top', 'FollowsController@show');

    // 検索フォーム
    Route::get('/search', 'UsersController@search');
    // ユーザーをフォローするためのPOSTリクエストのルート定義
    Route::post('/users/follow/{id}', 'UsersController@follow')->name('follow');
    //ユーザーのフォローを解除するためのPOSTリクエストのルート定義
    Route::post('/users/unfollow/{id}', 'UsersController@unfollow')->name('unfollow');

    // プロフィール編集ページを表示
    Route::get('/profile/edit', 'UsersController@profile');
    // プロフィールの更新処理
    Route::post('/profile/update', 'UsersController@update');

    // フォローリストページの表示
    Route::get('/follow-list', 'UsersController@followlist')->name('followlist');
    //フォローユーザーのプロフィールページの表示
    Route::get('/users/{id}', 'UsersController@show')->name('users.show');
    // フォロワーリストページの表示
    Route::get('/follower-list', 'UsersController@followers')->name('followers');


});

// ログアウト処理
// routes/web.php
// このコードは、/logout パスにPOSTリクエストが送信された場合に LoginController の logout メソッドを呼び出すルートを定義
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// 投稿一覧の表示
Route::get('/posts', 'PostsController@index')->name('post.index');
