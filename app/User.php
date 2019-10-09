<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'picture_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // diaries テーブルの関連をかく リレーションをやっておくとデータを取るのが簡単になる
    public function diaries()
    {
        // hasMany 関係をかく
        return $this->hasMany('App\Diary');
        // return $this->hasOne('App\Diary'); // 1対1
        // return $this->belongsToMany('App\Diary'); //　多対多

    }
}
