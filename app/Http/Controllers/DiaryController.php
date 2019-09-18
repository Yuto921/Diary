<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary; // App は Diary.php の namespace App; からきている

class DiaryController extends Controller
{
    // プロパティ

    // メソッド

    // 一覧表示するメソッド
    public function index()
    {
        // diariesテーブルのデータを全件取得
        // allメソッド : 全件データを取得するメソッド Modelクラスの中に入っているから使える。extendsしている
        $diaries = Diary::all(); // Diary だから、　diariesのテーブルにアクセス(この場合allメソッドを)する

        // dd($diaries); // var_dump + 処理をここで中断

        // view('フォルダ名.ファイル名(blade.phpは除く), [配列など渡してあげたいもの]');
        return view('diaries.index', [
            // キー と 値で渡す (別ファイルで、キーは、$diariesで指定)
            'diaries' => $diaries
        ]);
    }

    // 新規追加の画面を表示するメソッド
    public function create()
    {
        return view('diaries.create');
    }

    // 新規追加の場面で投稿ボタンが押されたとき
    // 投稿処理をするメソッド
    public function store(Request $request)
    {
        dd($request->title);
    }
}
