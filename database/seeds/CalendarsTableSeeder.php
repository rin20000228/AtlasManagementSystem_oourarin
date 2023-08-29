<?php

use Illuminate\Database\Seeder;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //初期データ
        DB::table('calendars')->insert([
            [
                'reserve_date' => '2023-08-16',
                'reserve_part' => '1',
            ]
            ]);
    }
}
