<?php

namespace App\Http\Requests\backEnd\xray;

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
            'xrayName' => 'required',
            'Medical_License_Number'  => '',
            'xray_License' => 'image|max:20000|required',
            'phoneNumber'   => 'required|unique:xrays|numeric',
            'idCode'        => 'unique:xrays',
            'countryCode'       => 'required',
            'telephone'     => '',
            'Hotline'    => '',
            'email'                 => 'required|email|unique:xrays',
            'password'          => 'required|confirmed',
            'password_confirmation'=>'sometimes|required_with:password',
            'is_labs'               => '',
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
