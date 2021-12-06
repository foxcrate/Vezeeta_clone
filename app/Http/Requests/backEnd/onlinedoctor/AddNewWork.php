<?php

namespace App\Http\Requests\backEnd\onlinedoctor;

use Illuminate\Foundation\Http\FormRequest;

class AddNewWork extends FormRequest
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
            'address' => 'required|string',
            'phoneNumber'   => 'required|numeric',
            'appointments'  => 'array|min:1|max:6',
            'wating'        => 'required|numeric|min:1',
            'fees'          => 'required|numeric|min:1',
            'latitude'          => '',
            'longitude'         => ''
        ];
    }
}
