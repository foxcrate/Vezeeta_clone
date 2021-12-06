<?php

namespace App\Http\Requests\backEnd\hosptail;

use Illuminate\Foundation\Http\FormRequest;

class StorePatien extends FormRequest
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
            'firstName' => 'required',
            'middleName'=> '',
            'lastName'  => 'required',
            'BirthDate' => 'required',
            'gender'   => 'required',
            'email'     => 'email|unique:patiens',
            'phoneNumber'   => 'required|unique:patiens|numeric',
<<<<<<< HEAD
=======
            'idCode'        => 'unique:patiens',
>>>>>>> d556aefce33aac132ed5a059f15a12642157ac5e
            'password'          => 'required|confirmed',
            'password_confirmation'=>'required|sometimes|required_with:password',
            'state'             => 'required',
            'jop'               => '',
            'race'              => '',
            'address'           => '',
            'role'              => '',
            'is_active'         => '',
            'countryCode'       => 'required',
            'online'            => '',
            'hosptail_id'       => '',
            'clinic_id'         => '',
        ];
    }
}
