<?php

namespace App\Http\Requests\backEnd\patien\child;

use Illuminate\Foundation\Http\FormRequest;

class StoreChild extends FormRequest
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
            'name' => 'required|string',
            'BirthDay' => 'required|date',
            'gender'    => 'required',
            'patient_id'    => ''
        ];
    }
}
