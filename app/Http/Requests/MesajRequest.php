<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MesajRequest extends FormRequest
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
        if (auth()->user()->type == "admin") {
            return [
                'baslik' => 'required | min:10| max:40',
                'mesaj' => 'required | min:10| max:300',
                'ogrenci' => 'required',
            ];
        } else {
            return [
                'baslik' => 'required | min:10| max:40',
                'mesaj' => 'required | min:10| max:300',
            ];
        }

    }

    public function attributes()
    {
        return [
            'baslik' => 'Mesaj Konusu',
            'mesaj' => 'Mesaj İçeriği',
            'ogrenci' => 'Alıcı',
        ];
    }
}