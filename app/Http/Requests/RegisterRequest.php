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
        'old_year' => 'required|numeric',
        'old_month' => 'required|numeric',
        'old_day' => 'required|numeric',
        'birth_day' => 'required|date|after:2000-01-01|before_or_equal:' . now()->format('Y-m-d'),
        'role' => 'required|in:1,2,3,4',
        'password' => 'required|string|min:8|max:30|confirmed',
        ];
        //in：ラジオボタンやプルダウンで用意している内容を選択しないときバリデーションに引っかかる
        //dd($rules);
    }
    // 生年月日の結合・バリデーションデータの更新
    public function getValidatorInstance()
    {
        //３つの値を一つにマージして、$birth_dayとする
        if ($this->input('old_day') && $this->input('old_month') && $this->input('old_year')) {
            $birth_day = implode('-', $this->only(['old_year', 'old_month', 'old_day']));
            $this->merge([
                'birth_day' => $birth_day,
            ]);
        }
        //dd($birth_day);
        return parent::getValidatorInstance();
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
        'after' => ':attributeは2000年1月1日以降の日付を指定してください。',
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
        'birth_day' => '生年月日',
        'role' => '役職',
        'password' => 'パスワード',
    ];
}

}
