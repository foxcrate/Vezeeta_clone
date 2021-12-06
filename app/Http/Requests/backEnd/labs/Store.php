<?php

namespace App\Http\Requests\backEnd\labs;

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
            'image' => 'image|max:20000',
            'labsName' => 'required',
            'Medical_License_Number'  => 'required',
            'labs_License' => 'image|required|max:20000',
            'phoneNumber'   => 'required|unique:labs',
            'idCode'        => 'unique:labs',
            'countryCode'       => 'required',
            'telephone'     => 'required',
            // 'phoneNumber'   => 'required',
            'Hotline'    => '',
            'country'           => '',
            'city'          => '',
            'area'          =>'',
            'street'             => '',
            'zip_code'              => '',
            'email'                 => 'required|email|unique:labs',
            'password'          => 'required|confirmed',
            'password_confirmation'=>'sometimes|required_with:password',
            'is_xrays'  => '',
            'role'  => '',
            'address'   => 'string',
            'latitude'          => '',
            'longitude'         => ''
        ];
    }
    public function messages()
    {
      return [
        'image.max' => 'Maximum file size to upload is 3MB (3072 KB). If you are uploading a photo, try to reduce its resolution to make it under 3MB',
        'phoneNumber.unique' => 'phone number exits'
      ];
    }
}
