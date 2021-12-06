<?php

namespace App\Http\Requests\backEnd\patien\donate;

use Illuminate\Foundation\Http\FormRequest;

class addMedical extends FormRequest
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
            'medicalDevicesName'    => 'required|string',
            'medicalDevicesInformation' => 'required|string',
            'medicalDevicesImage'   => 'required|image',
            'medicalCategory'       => 'required|string',
            'quantity'              => 'integer',
            'patient_id'        => 'required|exists:patiens,id'
        ];
    }
}
