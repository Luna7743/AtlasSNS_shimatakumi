<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

// Laravelのユーザー登録機能を管理するコントローラー
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        //ここから
        //バリデーション記述
        if($request->isMethod('post')){
            $request->validate([
            'username' => 'bail|required|unique:users|between:2,12',
            'mail' => 'bail|required|email|unique:users|between:5,40',
            'password' => 'bail|required|string|confirmed|regex:/^[a-zA-Z0-9]+$/|between:8,20',
            ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            // ユーザーの作成：
            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
                'images' => 'images/icon1.png',
            ]);

            //session機能利用して、ユーザー名表示
            $request->session()->put('username',$username);

            return redirect('added');
        }
        //ここまでがPOSTの処理

        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }


}
