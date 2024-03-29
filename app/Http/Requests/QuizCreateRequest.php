<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizCreateRequest extends FormRequest
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
            'title' => 'required | min:10|max:200',
            'description' => 'max:1000',
            'finished_at' => 'nullable|after:' . now(),
            'counter' => 'required',
            'gereken_min_not' => 'required',
            'kisi_sayisi' => 'required',


        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Sınav Başlığı',
            'description' => 'Sınav Açıklaması',
            'finished_at' => 'Bitiş Tarihi',
            'counter' => 'Sınav Süresi',
            'gereken_min_not' => 'Minimum Not',
            'kisi_sayisi' => 'Kişi Sayısı',
        ];
    }
}