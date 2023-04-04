<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionUpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'question' => 'required|min:3',
            'image' => 'image|nullable|max:2048|mimes:jpg,jpeg,png',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'answer5' => 'required',
            'correct_answer' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'question' => 'Soru',
            'image' => 'Fotoğraf',
            'answer1' => '1.Cevap',
            'answer2' => '2.Cevap',
            'answer3' => '3.Cevap',
            'answer4' => '4.Cevap',
            'answer5' => '5.Cevap',
            'correct_answer' => 'Doğru Cevap',
        ];
    }
}