<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary; // App は Diary.php の namespace App; からきている
use App\Http\Requests\CreateDiary; // 認証ルールを作ったRequestファイルを読み込む

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
    // 引数のRequest = $_POST みたいなイメージ
    public function store(CreateDiary $request)
    {
        // ここからデータの登録・・・投稿されたデータをdiariesテーブルに入れたい
        // Diaryモデルのインスタンスを取得
        $diary = new Diary();

        // 画面で入力されたタイトルを代入
        // 画面で渡ってきたtitle($requestに入っている)を、設定
        $diary->title = $request->title;
        // 画面で入力された本文を代入
        $diary->body = $request->body;
        $diary->user_id = \Auth::user()->id; //追加 ログインしてるユーザーのidを保存 \Auth::user() = ログインしているユーザー

        // モデルからデータベースにデータを追加するとき save() = INSERT INTO
        $diary->save(); // DBに保存

        // 一覧ページにリダイレクト (これやらないと、戻るボタン押したとき[二重登録される]) [フォームを再送信しますか？]のアラートが出なくなる
        // 戻ったときのフォームを再送信しますか？の対策のため
        return redirect()->route('diary.index');
    }

    // 削除を実行するメソッド
    public function destroy(Diary $diary) // バインディングした
    {
        // URLを直接入力しても表示できないようにする ログインしているユーザー != 投稿のユーザーIDと一致していなければ、
        if (\Auth::user()->id !== $diary->user_id) {
            abort(403);
        } 

        // Diaryモデルのインスタンス化 しなくてもいけるべや
        // $diaries = new Diary();

        // Diaryモデルを使って、削除したい要素の取得
        // $diary = $diaries->find($id);
        // $diary = Diary::find($id);
        
        // 取得した要素を削除
        $diary->delete();
        
        // 一覧画面に戻る
        return redirect()->route('diary.index');

    }

    // 編集画面を表示するメソッド
    // public function edit(int $id)
    public function edit(Diary $diary) // $diary = Diary::find($id); 自動的に該当するモデルのインスタンスを作成
    {

        // URLを直接入力しても表示できないようにする ログインしているユーザー != 投稿のユーザーIDと一致していなければ、
        if (\Auth::user()->id !== $diary->user_id) {
            abort(403);
        } 


        // この仕組みを、ルートモデルバインディング [バインド＝縛られる・対応]

        // IDをもとに1件取得　バインディングしたからいらない
        // $diary = Diary::find($id);

        // 編集画面を表示するとき、取得結果を渡す
        return view('diaries.edit', [
            'diary' => $diary
        ]);
    }

    // 編集処理をするメソッド
    public function update(CreateDiary $request, Diary $diary) // バインディングした
    {

        // URLを直接入力しても表示できないようにする ログインしているユーザー != 投稿のユーザーIDと一致していなければ、
        if (\Auth::user()->id !== $diary->user_id) {
            abort(403);
        }
        
        // IDをもとに、投稿のタイトル、本文を更新 インスタンス化しなくても使えるということは、static function find ()
        // $diary = Diary::find($id);

        $diary->title = $request->title;
        $diary->body = $request->body;

        $diary->save(); // updateしているからデータベースで自動で、更新の日時が入る migrationファイルにtimestampがある
        // 一覧ページにリダイレクト
        return redirect()->route('diary.index');
    }

    // いいねの数
    public function like(int $id)
    {
        $diary = Diary::where('id', $id)->with('likes')->first();
        // Diaryモデルのlikesメソッド
        $diary->likes()->attach(Auth::user()->id);
    }

}
