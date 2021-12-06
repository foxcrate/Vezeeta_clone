<?php

namespace App\Http\Requests\backEnd\clinic;

use Illuminate\Foundation\Http\FormRequest;

class StoreRaoucata extends FormRequest
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
            'prescription'  => 'string',
            'temperature'   => '',
            'blood_pressure'=> '',
            'diabetics'     => 'numeric',
            'jaw_type'      => '',
            'jaw_direction' => '',
            'teeth_type'    => '',
            'eye_type'      => '',
            'medication_name'=> 'array|min:1',
            'times_day'     => '',
            'time'          => '',
            'test_name'     => 'array|min:1',
            'ray_name'      => 'array|min:1',
            'test_description'  => '',
            'ray_description'   => ''
        ];
    }
}
