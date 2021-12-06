<?php

namespace App\Http\Requests\backEnd\child;

use Illuminate\Foundation\Http\FormRequest;

class VaccinationRequest extends FormRequest
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
            'at_birth' => 'array',
            'twoMonth' => 'array',
            'fourMonth' => 'array',
            'sixMonth' => 'array',
            'nineMonth' => 'array',
            'twelveMonth' => 'array',
            'eighteenMonth' => 'array',
            'fourtyTwo' => 'array',
        ];
    }
}
