<?php

namespace App\Http\Requests\backEnd\branch;

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
            'is_lab'    => '',
            'is_xray'   => '',
            'is_pharmacy'   => ''
        ];
    }
}
