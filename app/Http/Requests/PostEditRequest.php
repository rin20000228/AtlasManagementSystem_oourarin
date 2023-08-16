<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostEditRequest extends FormRequest
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
            'post_category_id' => 'required|exists:subcategories,id',
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:5000',
        ];
    }

    public function messages(){
        return [
        'required' => ':attributeは必ず入力してください。',
        'post_category_id.exists' => '選択された投稿カテゴリーが無効です。',
        'post_title.string' => ':attributeは文字列で入力してください。',
        'post_title.max' => '投稿タイトルは100文字以内で入力してください。',
        'post_body.max' => '投稿内容は5000文字以内で入力してください。',
    ];
}

    public function attributes()
    {
    return [
        'post_category_id' => '投稿カテゴリー',
        'post_title' => '投稿タイトル',
        'post_body' => '投稿内容',
    ];
}
}
