<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDiary extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // trueに変更
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // 勝手に以下の内容が実行される
    public function rules()
    {
        return [
            // 'htmlのname属性'  必須 = required
            'title' => 'required | max:30',
            'body' => 'required'
        ];
    }

    // エラー文言の設定
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
        ];
    }
}
