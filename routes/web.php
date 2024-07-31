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

// 登録ページ
Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

// 登録完了ページ
Route::get('/added', 'Auth\RegisterController@added');

//ミドルウェアを適応したいルートの設定を行います。(ログイン中のみ表示できる)
Route::middleware('Auth')->group(function () {
    //認証ユーザーとフォローユーザーの投稿を一覧表示
    Route::get('/top', 'PostsController@index')->name('top');
    // プロフィール編集ページを表示
    Route::get('/profile','UsersController@profile')->name('profile.edit');

    // 投稿フォーム
    //新規投稿
    Route::post('/postscreate', 'PostsController@store');
    //投稿の編集
    Route::post('/post/update', 'PostsController@update');
    //投稿の削除
    Route::delete('/post/{id}', 'PostsController@destroy')->name('post.destroy');

    // 検索フォーム
    Route::get('/search', 'UsersController@search');
    // ユーザーをフォローするためのPOSTリクエストのルート定義
    Route::post('/users/follow/{id}', 'UsersController@follow')->name('follow');
    //ユーザーのフォローを解除するためのPOSTリクエストのルート定義
    Route::post('/users/unfollow/{id}', 'UsersController@unfollow')->name('unfollow');
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
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
