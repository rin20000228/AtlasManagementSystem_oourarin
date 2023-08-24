<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MainCategoryRequest extends FormRequest
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
            'main_category_name' =>
                'required',
                'string',
                'max:100',
                'unique:main_category_name',
        ];
    }

    public function messages()
    {
        return [
            'main_category_name.required' => 'メインカテゴリー名は必須です。',
            'main_category_name.unique' => '入力されたメインカテゴリーはすでに登録済みです。',
        ];
    }

}
