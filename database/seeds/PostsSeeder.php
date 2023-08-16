<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
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
                'user_id' => '9',
                'post_title' => '8月16日',
                'post' => '今日のお知らせを入力してください。',
            ]
            ]);
    }
}
