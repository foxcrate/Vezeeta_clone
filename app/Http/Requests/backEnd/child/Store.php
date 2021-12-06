<?php

namespace App\Http\Requests\backEnd\child;

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
            'image' => 'required|image|max:3072',
            'child_name'    => 'required|string',
            'birthDay'      => 'required',
            'gender'        => 'required',
            'weight'        => '',
            'height'        => '',
            'weight_type'   => 'string',
            'blood'         => '',
            'disease'       => 'array',
            'Surgeries'     => 'array',
            'allergy'       => 'array',
            'medication'    => 'array',
            'fatherdisease' => 'array',
            'motherdisease' => 'array',
            'patient_id'    => 'required|exists:patiens,id'
        ];
    }
}
