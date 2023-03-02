<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $culum = [
            'user_name' => 'テスト太郎',
            'contents' => '試し書き',
        ];

        DB::table('posts')->insert($culum);
    }
}