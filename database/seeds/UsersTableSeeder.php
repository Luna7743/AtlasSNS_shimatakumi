<?php

use Illuminate\Database\Seeder;
use App\User; // Userモデルをインポート

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *データベース初期設定の実行
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'スペシャルウィーク',
                'mail' => 'tahaidao075@gmaol.com',
                'password' => bcrypt('password'),
                'bio' => 'こんにちは',
                'images' => 'images/icon4.png'
            ],
            [
                'username' => 'ハルウララ',
                'mail' => 'user1@example.com',
                'password' => bcrypt('password'),
                'bio' => 'こんにちは',
                'images' => 'images/icon6.png'
            ],
            [
                'username' => 'キングヘイロー',
                'mail' => 'user2@example.com',
                'password' => bcrypt('password'),
                'bio' => 'こんにちは',
                'images' => 'images/icon3.png'
            ],
            [
                'username' => 'グラスワンダー',
                'mail' => 'user3@example.com',
                'password' => bcrypt('password'),
                'bio' => 'こんにちは',
                'images' => 'images/icon7.png'
            ],
            [
                'username' => 'マルゼンスキー',
                'mail' => 'user4@example.com',
                'password' => bcrypt('password'),
                'bio' => 'こんにちは',
                'images' => 'images/icon5.png'
            ],
            // 追加のユーザーを必要に応じてここに追加
        ]);


    }
}
