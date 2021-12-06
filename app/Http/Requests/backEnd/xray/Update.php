<?php

namespace App\Http\Requests\BackEnd\xray;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'image' => 'image|max:20000',
            'xrayName' => '',
            'xray_License' => 'image',
            'phoneNumber'   => 'required|numeric|unique:xrays,phoneNumber,'.$this->id,
            'email' => 'email',
            'Hotline'   => 'numeric',
            'telephone' => 'numeric'
        ];
    }
}
