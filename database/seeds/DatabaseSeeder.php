<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            UsersTableSeeder::class, // 呼び出すように追加
            PostsTableSeeder::class,
            FollowsTableSeeder::class,
        ]);
    }
}
