<?php

namespace App\Http\Requests\backEnd\onlinedoctor;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'license_image' => 'image',
            'speciality_id'    => 'required',
            'phoneNumber'               => 'required|numeric|unique:online_doctors,phoneNumber,'.$this->id,
            'address'                   => 'required',
           ];
    }
}
