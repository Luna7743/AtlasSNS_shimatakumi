<?php

use Illuminate\Database\Seeder;

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
            'username' => 'シマ',
            'mail' => 'tahaidao075@gmaol.com',
            'password' => bcrypt('password'),
        ]);

    }
}
