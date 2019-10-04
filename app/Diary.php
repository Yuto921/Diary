<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    // リレーションを定義 linksテーブルを中間テーブルとした、多対多の関係
    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }
}
