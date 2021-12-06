<?php

namespace App\Http\Requests\backEnd\labs;

use Illuminate\Foundation\Http\FormRequest;

class addNewWork extends FormRequest
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
            'lab_name'      => 'string|required',
            'lab_id'        => 'integer|exists:labs,id',
            'latitude'          => '',
            'longitude'         => ''
        ];
    }
}
