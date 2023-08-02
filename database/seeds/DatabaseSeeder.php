<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //DatabaseSeederの中にあるUsersTableSeederを呼び出す指示
        //$this->call(UsersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
    }
}
