<?php

namespace App\Http\Requests\backEnd\nurse;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNurse extends FormRequest
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
            'phoneNumber' => 'required|numeric|unique:nurses,phoneNumber,'.$this->id,
            'IdCode' => 'unique:nurses,IdCode,'.$this->id,
            'countryCode'   => '',
            'information'   => 'required',
            'Nationality'    => 'required',
        ];
    }
}
