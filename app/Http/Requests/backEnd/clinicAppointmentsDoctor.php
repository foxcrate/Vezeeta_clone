<?php

namespace App\Http\Requests\backEnd;

use Illuminate\Foundation\Http\FormRequest;

class clinicAppointmentsDoctor extends FormRequest
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
            'doctor_id'     => 'integer|required|exists:online_doctors,id',
            'doctor_name'   => 'required|string',
            'doctor_address'    => 'required',
            'doctor_idCode'     => 'required|exists:online_doctors,idCode',
            'doctor_phoneNumber'=> 'required|exists:online_doctors,phoneNumber',
            'doctor_special'    => 'required|string|exists:doctor_specailties,name',
            'doctor_lat'        => 'required',
            'doctor_lan'        => 'required',
            'doctor_image'      => 'required',
            'clinic_id'         =>'required|exists:clinics,id'

        ];
    }
}
