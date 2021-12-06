<?php

namespace App\Http\Requests\backEnd\child;

use Illuminate\Foundation\Http\FormRequest;

class StoreRocata extends FormRequest
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
            'prescription'  => 'required',
            'medication'    => 'array|min:1|required',
            // 'times_day'     => '',
            // 'time'          => '',
            'rayName'       => 'array|min:1',
            'testName'       => 'array|min:1',
            // 'ray_description'   => '',
            // 'test_description'  => '',
        ];
    }
}
