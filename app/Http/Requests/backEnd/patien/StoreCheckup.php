<?php

namespace App\Http\Requests\backEnd\patien;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckup extends FormRequest
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
            'temperature'   => 'required',
            'blood_pressure'    => 'required',
            'diabetics' => 'required',
            'date'      => 'string',
            'oxygen'    => 'required',
            'patient_id' => 'required|exists:patiens,id'
        ];
    }
}
