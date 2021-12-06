<?php

namespace App\Http\Requests\backEnd\branch;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctor extends FormRequest
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
            'image' => 'image|max:20000|required',
            'name'  => 'required',
            'phoneNumber' => 'required|unique:doctors|numeric',
            'countryCode'   => '',
            'password'      => 'required',
            'Primary_Speciality'    => 'required',
            'degree'    => 'required',
            'information'   => 'required',
            'national_id_front_side'    => 'image|max:1024|required',
            'national_id_back_side'     => 'image|max:1024|required',
            'national_id'               => 'required|max:14',
            'branch'                    => '',
            'Nationality'               => 'required',
        ];
    }
}
