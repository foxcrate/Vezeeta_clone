<?php

namespace App\models;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Hosptail extends Authenticatable implements MustVerifyEmail
{use Notifiable,HasApiTokens;
    protected $fillable = [
    'image',
    'hosptailName',
    'Primary_Speciality',
    'Medical_License_Number',
    'Hosptail_License',
    'phoneNumber',
    'telephone',
    'Hotline',
    'email',
    'password',
    'role',
    'password_confirmation',
    'address',
    'verify',
    'countryCode',
    'hosptail_branch',
    'idCode',
    'latitude',
    'longitude',
    'is_active',
    'hosptail_labs',
    'hosptail_xray',
    'hosptail_pharmacy',

];
   protected $hidden =['created_at','updated_at'];
   protected $casts=[
    'hosptail_labs' => 'boolean',
    'hosptail_xray' => 'boolean',
    'hosptail_pharmacy' => 'boolean',
    'is_active' => 'boolean'
    ];

    public function doctors(){
        return $this->hasMany('App\models\Doctor','hosptail_id');
    }
    public function patiens(){
        return $this->hasMany('App\models\Patien','hosptail_id');
    }
    public function branch(){
        return $this->hasMany('App\models\Branch','hosptail_id');
    }

    public function hosptailDoctorAppoiemnts(){
        return $this->hasMany('App\models\hospitalAppointment','hospital_id');
    }
}
