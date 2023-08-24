<?php

use Illuminate\Database\Seeder;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //サブカテゴリーの追加
        DB::table('sub_categories')->insert([
            [
                'main_category_id' => '1',
                'sub_category' => 'S-1'
            ],
            [
                'main_category_id' => '2',
                'sub_category' => 'H-1'
            ],
            [
                'main_category_id' => '3',
                'sub_category' => 'R-1'
            ]
            ]);
    }
}
