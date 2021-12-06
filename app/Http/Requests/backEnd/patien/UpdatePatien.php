<?php

namespace App\Http\Requests\BackEnd\patien;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatien extends FormRequest
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
            'image' => 'image|max:3072',
            // 'gender'   => 'required|in:male,female',
            'email'     => 'required|email',
            'phoneNumber'   => 'required|numeric|unique:patiens,phoneNumber,'.$this->id,
            // 'idCode'        => 'unique:patiens,idCode,'.$this->id,
            'state'             => 'required|in:single,married,divorce',
            'address'           => 'required',
        ];
    }
}
