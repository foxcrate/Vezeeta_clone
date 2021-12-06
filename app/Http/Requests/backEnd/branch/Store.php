<?php

namespace App\Http\Requests\backEnd\branch;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'Name' => 'required|string',
            'phoneNumber'   => 'required|numeric',
            'address'       => 'required|string',
            'password'      => '',
            'is_xray'       => '',
            'is_lab'        => '',
            'is_pharmacy'   => '',
            'hosptail_id'   => '',
            'clinic_id'     => '',
            'xray_id'       => '',
            'lab_id'        => '',
            'pharmacy_id'   => '',
        ];
    }
}
