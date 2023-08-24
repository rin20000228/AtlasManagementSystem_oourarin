<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            //サブカテゴリーテーブルにidが存在するか
            //テーブルとカラム名のつなぎは[,]を使用
            'post_category_id' => 'required|exists:sub_categories,id',
            'post_title' => 'min:4|max:50',
            'post_body' => 'min:10|max:500',
        ];
    }

    public function messages(){
        return [
            'post_category_id.required' => '投稿カテゴリーを選択してください。',
            'post_category_id.exists' => '選択された投稿カテゴリーは無効です。',
            'post_title.min' => 'タイトルは4文字以上入力してください。',
            'post_title.max' => 'タイトルは50文字以内で入力してください。',
            'post_body.min' => '内容は10文字以上入力してください。',
            'post_body.max' => '最大文字数は500文字です。',
        ];
    }
}
