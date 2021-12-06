<?php

namespace App\Http\Requests\BackEnd\labs;

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
            'labs_License'  => '',
            'phoneNumber'   => 'required|unique:labs,phoneNumber,'.$this->id,
            'email'                 => 'email',
            'Hotline'               => 'numeric',
            'telephone'             => 'numeric'
        ];
    }
}
