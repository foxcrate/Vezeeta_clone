<?php

namespace App\Http\Requests\backEnd\onlinedoctor;

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
            'image' => 'image|max:3072|required',
            'name'  => 'required',
            'phoneNumber' => 'required|unique:online_doctors|numeric',
            'countryCode'       => 'required',
            'idCode'        => 'unique:online_doctors',
            'password'          => 'required|confirmed',
            'password_confirmation'=>'required|sometimes|required_with:password',
            'speciality_id'    => 'required',
            'degree'    => 'required',
            'degree_image'    => 'image|max:2048|required',
            'license_image'    => 'image|max:2048|required',
            'information'   => 'required',
            'national_id_front_side'    => 'image|max:2048|required',
            'national_id_back_side'     => 'image|max:2048|required',
            'license_number'               => 'required|numeric',
            'branch'                    => '',
            'Nationality'               => 'required',
            'address'                   => '',
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
