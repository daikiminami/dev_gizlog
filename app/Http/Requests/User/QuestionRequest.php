<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
        return
        [
            'tag_category_id' => 'exists:tag_categories,id',
            'title' => 'required|max:100',
            'content' => 'required|max:1000'
        ];
    }

    public function messages()
    {
        return 
        [
            'tag_category_id.exists' => '入力必須項目です',
            '*.required' => '入力必須項目です',
            '*.max' => ':max文字以内の文字を入力してください'
        ];
    }
}

