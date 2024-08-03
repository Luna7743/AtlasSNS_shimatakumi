<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'bio', 'images'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function follows() //ログインユーザーがフォローしているユーザーを取得
    {
        // belongsToMany: 多対多のリレーションを定義
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    public function followers() //ログインユーザーをフォローしているユーザーを取得
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    public function isFollowing($userId) //isFollowing: 特定のユーザーをフォローしているかを確認
    {
        return $this->follows()->where('followed_id', $userId)->exists();
        // where('followed_user_id', $userId): フォローしているユーザーのIDを検索条件にします。
        // exists(): 条件に一致するレコードが存在するかを確認します。
    }

    public function posts() //ユーザーの投稿を取得
    {
        //hasMany: 1対多のリレーションを定義
        return $this->hasMany(Post::class);
    }

}
