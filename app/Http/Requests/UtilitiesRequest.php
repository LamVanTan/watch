<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UtilitiesRequest extends FormRequest
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
            'tienich' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'tienich.required' => 'tên tiện ích không được trống',
            'tienich.min' => 'Tên tiện ích quá ngắn'
        ];
    }
}
