<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //アクセスに対してフォームリクエストの許可する
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //バリデーションを定義（連想配列）
        'over_name' => 'required|string|max:10',
        'under_name' => 'required|string|max:10',
        'over_name_kana' => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
        'under_name_kana' => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
        'mail_address' => 'required|email|unique:users|max:100',
        'sex' => 'required|in:1,2,3',
        'old_year' => 'required|date_format:Y-m-d|before_or_equal:today',
        'old_month' => 'required|date_format:m',
        'old_day' => 'required|date_format:d',
        'role' => 'required|in:1,2,3,4',
        'password' => 'required|string|min:8|max:30|confirmed',
        ];
        //in：ラジオボタンやプルダウンで用意している内容を選択しないときバリデーションに引っかかる
        //dd($rules);
    }

    //エラーメッセージ
    public function messages()
    {
        return [
        'required' => ':attributeは必ず入力してください。',
        'string' => ':attributeの形式で入力してください。',
        'email' => ':attributeの形式が正しくありません。',
        'unique' => ':attributeは既に使用されています。',
        'max' => ':attributeは:max文字以内で入力してください。',
        'min' => ':attributeは:min文字以上で入力してください。',
        'in' => '選択された:attributeが無効です。',
        'date_format' => ':attributeの形式が正しくありません。',
        'before_or_equal' => ':attributeは今日以前の日付を指定してください。',
        'regex' => ':attributeの形式で入力してください。',
        'confirmed' => ':attributeが一致しません。',
        ];
    }

    public function attributes()
    {
    return [
        'over_name' => '名前',
        'under_name' => '名前',
        'over_name_kana' => 'カタカナ',
        'under_name_kana' => 'カタカナ',
        'mail_address' => 'メールアドレス',
        'sex' => '性別',
        'old_year' => '生年月日',
        'old_month' => '生年月日',
        'old_day' => '生年月日',
        'role' => '役職',
        'password' => 'パスワード',
    ];
}

}
