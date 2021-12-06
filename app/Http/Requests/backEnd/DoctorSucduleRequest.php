<?php

namespace App\Http\Requests\backEnd;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSucduleRequest extends FormRequest
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
            'patient_phone'  => 'required',
            'patient_name'  => 'required|string',
            'appointmentsD' => 'required|string',
            'appointmentsF' => 'required|string',
            'appointmentsT' => 'required|string',
            'appoiment_id'  => 'required|exists:appointments,id'
        ];
    }
}
