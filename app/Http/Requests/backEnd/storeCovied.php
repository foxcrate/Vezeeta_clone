<?php

namespace App\Http\Requests\backEnd;

use Illuminate\Foundation\Http\FormRequest;

class storeCovied extends FormRequest
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
          'linkpcr'    => 'required',
          'linkvac'      => 'required',
          'countryFrom' => 'required',
          'countryTo'   => 'required',
          'patient_id'  => 'integer|exists:patiens,id'
        ];
    }
}
