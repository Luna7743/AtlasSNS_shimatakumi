<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

// Laravelの認証システムにおけるパスワードリセット処理を担当
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // ResetsPasswordsトレイトを使用することで、パスワードリセットの処理が自動的に組み込まれます
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    // パスワードリセットが成功した後にリダイレクトするURLを指定します。
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //  認証されていないゲストユーザー（ログインしていないユーザー）のみがこのコントローラーのアクションにアクセスできるようにするためのものです。
    public function __construct()
    {
        $this->middleware('guest');
    }
}
