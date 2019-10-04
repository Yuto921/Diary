<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 
// Route::get('/', function () {
//     return view('welcome');
// });

/*
// ルートの設定
// Route::get GET送信のこと
// Route::post POST送信のこと
Route::get('/', 'DiaryController@index')->name('diary.index');

Route::get('diary/create', 'DiaryController@create')->name('diary.create');

// 省略するためにnameを使ってaction先を書く <form action="{{ route('diary.create') }}" method="POST">
Route::post('diary/create', 'DiaryController@store')->name('diary.create');

// deleteという送信方法をしている {id} キー：自分で決め打ちしている
Route::delete('diary/{id}/delete', 'DiaryController@destroy')->name('diary.destroy');

Route::get('/diary/{id}/edit', 'DiaryController@edit')->name('diary.edit');

// putという送信方法をしている {id} キー：自分で決め打ちしている /diary/{id}　これでも動く
Route::put('/diary/{id}/update', 'DiaryController@update')->name('diary.update');

// php artisan route:list でルートの行き先が見れるよ
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/

// routes//web.php

Route::get('/', 'DiaryController@index')->name('diary.index');


// 一覧以外のページはログインしていないと表示(実行)できないように変更 ログインしていない場合リダイレクト
Route::group(['middleware' => 'auth'], function() {
    Route::get('diary/create', 'DiaryController@create')->name('diary.create');
    Route::post('diary/create', 'DiaryController@store')->name('diary.create');
    
    Route::get('diary/{diary}/edit', 'DiaryController@edit')->name('diary.edit');
    Route::put('diary/{diary}/update', 'DiaryController@update')->name('diary.update');
    
    Route::delete('diary/{diary}/delete', 'DiaryController@destroy')->name('diary.destroy');

    Route::post('diary/{id}/like', 'DiaryController@like');
    Route::post('diary/{id}/dislike', 'DiaryController@dislike');
});

Auth::routes();
