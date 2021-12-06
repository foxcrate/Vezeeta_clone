<?php

namespace App\Http\Requests\backEnd\clinic;

use Illuminate\Foundation\Http\FormRequest;

class updateDepartement extends FormRequest
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
            'clinic_lab'    => '',
            'clinic_xray'   => '',
            'clinic_pharmacy'   => ''
        ];
    }
}
