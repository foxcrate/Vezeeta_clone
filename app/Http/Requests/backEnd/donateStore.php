<?php

namespace App\Http\Requests\backEnd;

use Illuminate\Foundation\Http\FormRequest;

class donateStore extends FormRequest
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
            'blood' => 'required',
            'patient_id' => 'required|integer|exists:patiens,id',
            'address'   => 'required|string',
            'latitude'  => 'required',
            'longitude' => 'required',
            'details'   => 'required',
            'patientName'   => 'required',
            'fileNumber'    => 'required|integer',
        ];
    }
}
