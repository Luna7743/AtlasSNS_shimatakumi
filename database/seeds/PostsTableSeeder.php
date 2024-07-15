<?php

use Illuminate\Database\Seeder;
use App\Posts;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => 11, // スペシャルウィークのID
                'post' => 'スペシャルウィークの投稿1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 12, // ハルウララのID
                'post' => 'ハルウララの投稿1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 13, // キングヘイローのID
                'post' => 'キングヘイローの投稿1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 14, // グラスワンダーのID
                'post' => 'グラスワンダーの投稿1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 追加の投稿を必要に応じてここに追加
        ]);
    }
}
