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
            'title' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return 
        [
            'tag_category_id.exists' => '入力必須項目です',
            '*.required' => '入力必須項目です'
        ];
    }
}

