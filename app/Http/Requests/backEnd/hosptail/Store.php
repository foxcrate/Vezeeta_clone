<?php

namespace App\Http\Requests\backEnd\hosptail;

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
            'image' => 'image|max:3072',
            'hosptailName' => 'required',
            'Primary_Speciality'=> 'required',
//            'degree'            => 'required',
//            'medical_description'=> 'required',
            'Medical_License_Number'  => 'required|numeric',
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
    public function messages()
    {
      return [
        'image.max' => 'Maximum file size to upload is 3MB (3072 KB). If you are uploading a photo, try to reduce its resolution to make it under 3MB',
        'phoneNumber.unique' => 'phone number exits'
      ];
    }
}
