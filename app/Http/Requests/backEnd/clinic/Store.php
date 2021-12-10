<?php

namespace App\Http\Requests\backEnd\clinic;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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

    public function __construct()
    {
        return "Alo";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $this->set( 'phoneNumber' , "Alo" )  ;
        // dd( $this->get('phoneNumber') );
        //$x = $this->countryCode.$this->phoneNumber;
        // if($this->phoneNumber[0] == '0'){
        //     $x =  $this->countryCode . substr($this->phoneNumber,1);
        // }else{
        //      $x = $this->countryCode . $this->phoneNumber;
        // }
        // dd( $x);

        return [
            'image' => 'image|max:20000',
            'clinicName' => 'required',
            'Primary_Speciality'=> 'required',
            'Medical_License_Number'  => 'required|numeric',
            'Clinic_License' => 'required|image|max:1024',
            'phoneNumber'   => 'required|unique:clinics',
            'idCode'        => 'unique:clinics',
            'countryCode'       => 'required',
            'telephone'     => 'numeric',
            // 'phoneNumber'   => 'required',
            'Hotline'    => 'numeric',
            // 'country'           => '',
            // 'city'          => '',
            // 'area'          =>'',
            // 'street'             => '',
            // 'zip_code'              => '',
            'email'                 => 'required|email|unique:clinics',
            'password'          => 'required|confirmed',
            'password_confirmation'=>'sometimes|required_with:password',
            'address'   => 'string|required',
            'role'  => '',
            'latitude'          => '',
            'longitude'         => ''
        ];
    }

    public function messages()
    {
      return [
        'image.max' => 'Maximum file size to upload is 3MB (3072 KB). If you are uploading a photo, try to reduce its resolution to make it under 3MB',
        'phoneNumber.unique' => 'phone number exits'
      ];
    }
}
