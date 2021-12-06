<?php

namespace App\Http\Requests\backEnd\child;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRay extends FormRequest
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
            'ray_child_id'   => 'array|min:1',
        ];
    }
}
