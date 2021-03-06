<?php

namespace App\Http\Requests\backEnd;

use Illuminate\Foundation\Http\FormRequest;

class stogreRay extends FormRequest
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
            'result_name' => 'required|max:10000',
            'link'   => 'array|min:1',
        ];
    }
}
