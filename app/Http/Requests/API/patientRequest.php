<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class patientRequest extends FormRequest
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
            'image' => 'image|max:3071|mimes:png,jpg',
            'firstName' => 'required|string',
            'middleName'=> 'string',
            'lastName'  => 'required|string',
            'BirthDay' => 'required',
            'gender'   => 'required|in:male,female',
            'email'     => 'email|unique:patiens',
            'phoneNumber'   => 'required|numeric|unique:patiens,phoneNumber',
            'password'          => 'required|confirmed',
            'password_confirmation'=>'required|sometimes|required_with:password',
            'state'             => 'required',
            'jop'               => 'string',
            'race'              => 'string',
            'address'           => 'required|string',
            'countryCode'       => '',
            'latitude'          => '',
            'longitude'         => ''
        ];
    }
}
