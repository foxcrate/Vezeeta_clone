<?php

namespace App\Http\Requests\backEnd\nurse;

use Illuminate\Foundation\Http\FormRequest;

class NurseStore extends FormRequest
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
            'name'  => 'required',
            'phoneNumber' => 'required|unique:nurses,phoneNumber,'.$this->id,
            'idCode'        => 'unique:nurses,idCode,'.$this->id,
            'email'         => 'email|unique:nurses',
            'countryCode'   => '',
            'password'          => 'required|confirmed',
            'password_confirmation'=>'required|sometimes|required_with:password',
            'information'   => 'required',
            'national_id_front_side'    => 'image|max:1024|required',
            'national_id_back_side'     => 'image|max:1024|required',
            'national_id'               => 'required|max:14',
            'Nationality'               => 'required',
            'is_active'                 => '',
            'latitude'          => 'required',
            'longitude'         => 'required'
        ];
    }
}
