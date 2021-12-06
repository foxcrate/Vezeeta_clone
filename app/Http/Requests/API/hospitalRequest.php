<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class hospitalRequest extends FormRequest
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
            'image' => 'image|max:3072',
          
          
            'Hosptail_License' => 'image|max:20000|required',
            'phoneNumber'   => 'required|unique:hosptails|numeric',
            'idCode'        => 'unique:hosptails',
            'telephone'     => 'numeric',
            // 'phoneNumber'   => 'required',
            'Hotline'    => 'numeric',
            // 'country'           => '',
            // 'city'          => '',
            // 'area'          =>'',
            // 'street'             => '',
            // 'zip_code'              => '',
            'email'                 => 'email|unique:hosptails',
            'password'          => 'required|confirmed',
            'password_confirmation'=>'sometimes|required_with:password',
            'role'  => '',
            'hosptail_labs' => '',
            'hosptail_xray' => '',
            'hosptail_pharmacy' => '',
            'countryCode'       => 'required',
            'address'   => 'string|required',
            'latitude'          => '',
            'longitude'         => ''
        ];
    }
}
