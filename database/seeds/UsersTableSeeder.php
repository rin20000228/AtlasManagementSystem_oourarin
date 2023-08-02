<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //↓レコード初期値登録
        DB::table('users')->insert([
            [
                'over_name' => '織田',
                'under_name' => '信長',
                'over_name_kana' => 'オダ',
                'under_name_kana' => 'ノブナガ',
                'mail_address' => 'oda@nobunaga01',
                'sex' => '1',
                'birth_day' => '1534-06-23',
                'role' => '4',
                //パスワードの暗号処理
                'password' => bcrypt('password')
            ],
            [
                'over_name' => '徳川',
                'under_name' => '家康',
                'over_name_kana' => 'トクガワ',
                'under_name_kana' => 'イエヤス',
                'mail_address' => 'tokugawa@ieyasu02',
                'sex' => '1',
                'birth_day' => '1543-01-31',
                'role' => '4',
                //パスワードの暗号処理
                'password' => bcrypt('password')
            ]

        ]);
    }
}
