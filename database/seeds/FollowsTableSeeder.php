<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //フォローデータの作成
        DB::table('follows')->insert([
            [
                'following_id' => 11, // フォロワーユーザー1
                'followed_id' => 3  // ログインユーザー
            ],
            [
                'following_id' => 12, // フォロワーユーザー2
                'followed_id' => 3  // ログインユーザー
            ],
            [
                'following_id' => 13, // フォロワーユーザー3
                'followed_id' => 3  // ログインユーザー
            ],
            [
                'following_id' => 14, // フォロワーユーザー4
                'followed_id' => 3  // ログインユーザー
            ],
        ]);
    }
}
