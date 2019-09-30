<?php

use Illuminate\Database\Seeder;

// 追加
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; //これがなくてもいけるみたい Laravelの方で、自動でDBで読み出せるように設定されている config/appの方に記述されている

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'pikopoko',
            'email' => 'pikopoko@gmail.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
