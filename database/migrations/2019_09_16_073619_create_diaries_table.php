<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            // diariesテーブルの設計図
            $table->increments('id'); // AI プライマリーキーのこと
            $table->string('title', 30); // string=varcharのこと 文字が入って30字まで
            $table->text('body');
            $table->timestamps(); // timestamps　だけで勝手にcreated_atとupdated_atができる
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diaries');
    }
}
