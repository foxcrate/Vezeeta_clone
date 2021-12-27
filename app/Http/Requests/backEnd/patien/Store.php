<?php

namespace App\Http\Requests\backEnd\patien;

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
            'image' => 'max:20000',
            'firstName' => 'required',
            'middleName'=> '',
            'lastName'  => 'required',
            'name'      => '',
            'BirthDate' => 'required',
            'gender'   => 'required',
            //'email'     => 'nullable|email|unique:patiens',
            'phoneNumber'   => 'required|numeric|unique:patiens,phoneNumber',
            'idCode'        => 'unique:patiens',
            'password'          => 'required|confirmed',
            'password_confirmation'=>'required|sometimes|required_with:password',
            //'state'             => 'required',
            // 'job'               => '',
            // 'race'              => '',
            //'address'           => 'required|string',
            'role'              => '',
            'is_active'         => '',
            'countryCode'       => 'required',
            'online'            => '',
            // 'latitude'          => '',
            // 'longitude'         => ''
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
