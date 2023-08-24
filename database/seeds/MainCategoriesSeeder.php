<?php

use Illuminate\Database\Seeder;

class MainCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //メインカテゴリーの追加
        DB::table('main_categories')->insert([
           ['main_category' => 'R-1'],
           ['main_category' => 'I-1'],
           ['main_category' => 'N-1']
        ]);
    }
}
