<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // ユーザー検索
    public function search(Request $request)
    {
        $search = $request->input('search'); // フォームからの検索ワードを取得
        // dd($search);

        // 検索ワードが入力されている場合
        if ($search) {
            $users = User::where('username', 'LIKE', "%{$search}%")
                ->where('id', '!=', Auth::id())
                ->get();
        } else {
            // 何も検索していない時は全てのユーザーを表示
            $users = User::where('id', '!=', Auth::id())->get();
        }

        return view('users.search', [
            'users' => $users, // 検索結果のユーザー一覧
            'search' => $search, // 検索ワード
        ]);
    }

    // ログインユーザー以外のプロフィールページを表示する
    public function show($id)
    {
        $user = User::findOrFail($id);
        $isFollowing = Auth::user()->isFollowing($user->id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();

        return view('users.show', [
            'user' => $user,
            'isFollowing' => $isFollowing,
            'posts' => $posts,
        ]);
    }

    // フォロー機能
    public function follow($id)
    {
        $user = User::findOrFail($id);
        Auth::user()
            ->follows()
            ->attach($user->id);
        return back();
    }

    // フォロー解除機能
    public function unfollow($id)
    {
        $user = User::findOrFail($id);
        Auth::user()
            ->follows()
            ->detach($user->id);
        return back();
    }

    // フォローリストページの表示
    public function followlist()
    {
        //自分がフォローしているユーザーを取得
        $followingUsers = Auth::user()->follows()->get();
        // dd($followingUsers);

        // 自分がフォローしているユーザーの投稿を取得し、降順に並べ替える
        $posts = Auth::user()
            ->follows()
            ->with([
                'posts' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])
            ->get()
            ->pluck('posts')
            ->flatten()
            ->sortByDesc('created_at');

        return view('follows.followList', [
            'followingUsers' => $followingUsers,
            'posts' => $posts,
        ]);
    }

    //フォロワーリストページの表示
    public function followers()
    {
        // 自分をフォローしているユーザーを取得
        $followers = Auth::user()->followers()->get();

        // 自分をフォローしているユーザーの投稿を取得し、降順に並べ替える
        $posts = Auth::user()
            ->followers()
            ->with([
                'posts' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])
            ->get()
            ->pluck('posts')
            ->flatten()
            ->sortByDesc('created_at');

        return view('follows.followerList', [
            'followers' => $followers,
            'posts' => $posts,
        ]);
    }

    // プロフィール編集ページを表示
    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    // プロフィール更新処理
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|max:40|unique:users,mail,' . $user->id,
            'password' => 'nullable|string|min:8|max:20|confirmed',
            'bio' => 'nullable|string|max:150',
            'image' => 'nullable|image|mimes:jpg,png,bmp,gif,svg|max:2048',
        ]);

        // ユーザー情報の更新
        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->bio = $request->input('bio');

        //保存用
        // //画像ファイルをアップロードして保存する
        // if ($request->hasFile('image')) {
        //     //←リクエストに画像ファイルが含まれているかを確認
        //     $name = $request->file('image')->getClientOriginalName(); //アップロードされた画像ファイルの元の名前を取得
        //     $path = $request->file('image')->storeAs('images', $name, 'public');
        //     $user->images = $path;
        // }

        //画像ファイルをアップロードして保存する
        if ($request->hasFile('image')) {
            //アップロードされた画像ファイルの元の名前と拡張子を取得
            $originalName = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();

            //タイムスタンプをつけて新しいファイル名を生成
            $timestamp = now()->format('YmdHis');
            $filename = pathinfo($originalName, PATHINFO_FILENAME) . '_' . $timestamp . '.' . $extension;

            //画像を指定のパスに保存
            $path = $request->file('image')->storeAs('images', $filename, 'public');

            //保存した画像のパスをユーザーの images フィールドに設定
            $user->images = $path;
        }

        // パスワードの更新
        $passwordChanged = false;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
            $passwordChanged = true;
        }

        $user->save();

        // パスワードが変更された場合にログアウト処理を実行
        if ($passwordChanged) {
            Auth::logout();
            $request->session()->invalidate(); //現在のセッションを無効化します。
            $request->session()->regenerateToken(); //セッション固定攻撃を防ぐために、新しいセッショントークンを生成します。

            return redirect('/login')->with('success', 'パスワードが更新されました。もう一度ログインしてください。');
        }

        return redirect('/profile');
    }
}
