<?php

use Illuminate\Database\Seeder;

// 追加
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DiariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() // この中にサンプルデータを記述する
    {
        // first() usersテーブルの一番最初のカラムを取得
        $user = DB::table('users')->first(); //追加

        //(ただ書いているだけ=次の作業を楽にするため)
        $diaries = [
            [
                'title' => '初めてのセブ',
                'body' => 'PC日本に忘れた'
            ],
            [
                'title' => '週末のオスロブ',
                'body' => 'ジンベイザメでか'
            ],
            [
                'title' => '卒業',
                'body' => 'パスポート寮に忘れたw'
            ],
            [
                'title' => 'メル',
                'body' => 'Coffee Bayの店員さん'
            ]
        ];

        foreach ($diaries as $diary) {
            // DBにデータを追加する
            DB::table('diaries')->insert([
                'title' => $diary['title'],
                'body' => $diary['body'],
                'user_id' => $user->id, //追加
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
