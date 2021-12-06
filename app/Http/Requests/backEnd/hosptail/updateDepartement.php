<?php

namespace App\Http\Requests\backEnd\hosptail;

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
            'hosptail_lab'    => '',
            'hosptail_xray'   => '',
            'hosptail_pharmacy'   => ''
        ];
    }
}
