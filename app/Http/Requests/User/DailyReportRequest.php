<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class DailyReportRequest extends FormRequest
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
        $today = Carbon::now()->format("Y-m-d");
        return
        [
            'reporting_time' => 'required|date|before_or_equal:'.$today,
            'title' => 'required|string|max:30',
            'content' => 'required|string|max:300'
        ];
    }
  
    public function messages()
    {
        return[
            '*.required' => '入力必須項目です',
            'reporting_time.date' => '入力文字が不正です',
            'reporting_time.before_or_equal' => '今日以前の日付を入力してください',
            '*.max' => ':max文字以内を入力してください'
        ];
    }
}

