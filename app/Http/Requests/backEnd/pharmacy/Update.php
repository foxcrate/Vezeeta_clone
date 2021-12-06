<?php

namespace App\Http\Requests\BackEnd\pharmacy;

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
            'pharmacy_License'  => '',
            'phoneNumber'   => 'required|numeric|unique:pharmacies,phoneNumber,'.$this->id,
            'email'         => 'email',
            'Hotline'       => 'numeric',
            'telephone'     => 'numeric'
        ];
    }
}
