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
                'user_id' => '2',
                'post_title' => '今週の献立',
                'post' => '今週はデザートなしです。',
            ]
            ]);
    }
}
