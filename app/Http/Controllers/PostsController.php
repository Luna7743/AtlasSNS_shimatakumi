<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 追加
//Post モデルをインポートします。これは、データベースの posts テーブルと対応しています。
use App\Post;
//Auth ファサードは、認証ユーザーの情報を取得するために使用されます。
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // 新規投稿
    public function store(Request $request)
    {
        // dd($request);
        // バリデーションルール
        $request->validate([
            'post' => 'required|min:1|max:150',
        ]);

        // 新しい投稿を作成
        // フォームから送信された投稿内容を取得します。
        $post = $request->input('post');
        // dd($post);
        //現在の認証ユーザーのIDを取得します。
        $user_id = Auth::id();
        // dd($user_id);

        Post::create([
            'post' => $post,
            'user_id' => $user_id,
        ]);

        // 投稿後のリダイレクト
        return redirect()->route('top')->with('success', '投稿が成功しました');
    }

    //認証ユーザーの投稿を一覧表示します。
    public function index()
    {
        //自分と自分がフォローしているユーザーの投稿のみ表示
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)
                    ->orWhereIn('user_id', $user->follows()->pluck('followed_id'))
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('posts.index', ['posts' => $posts]);
    }


    // 投稿の編集処理
    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
        'uppost' => 'required|min:1|max:150',
        ]);

        // 投稿を取得
        $uppost = $request->input('uppost');
        $post_id = $request->input('post_id');
        $post = Post::findOrFail($post_id);

        //投稿を更新
        $post->update([
            'post' => $uppost
        ]);

        // リダイレクト
        return redirect()->route('top')->with('success', '投稿が更新されました');
    }

    // 投稿の削除
    public function destroy($id)
    {
        // 投稿を取得
        $post = Post::findOrFail($id);
        // 認証ユーザーの確認
        if ($post->user_id != Auth::id()) {
            return redirect()->route('top')->with('error', '削除権限がありません');
        }
        // 投稿を削除
        $post->delete();
        //リダイレクト
        return redirect()->route('top')->with('success', '投稿が削除されました');
    }


}
