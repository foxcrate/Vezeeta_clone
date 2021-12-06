<?php

namespace App\models;
use Laravel\Passport\HasApiTokens;
use Ilsluminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Clinic extends Authenticatable implements MustVerifyEmail
{use Notifiable,HasApiTokens;
    protected $fillable = [
        'image',
        'clinicName',
        'Primary_Speciality',
        'Medical_License_Number',
        'Clinic_License',
        'phoneNumber',
        'telephone',
        'Hotline',
        'email',
        'password',
        'password_confirmation',
        'role',
        'clinic_labs',
        'clinic_xray',
        'clinic_pharmacy',
        'address',
        'countryCode',
        'clinic_branch',
        'idCode',
        'latitude',
        'longitude',
    ];
    protected $casts=['clinic_labs' => 'boolean',
    'clinic_xray' => 'boolean',
    'clinic_pharmacy' => 'boolean'];
    public function doctors(){
        return $this->hasMany('App\models\Doctor','clinic_id');
    }
    public function patiens(){
        return $this->hasMany('App\models\Patien','clinic_id');
    }
    public function branch(){
        return $this->hasMany('App\models\Branch','clinic_id');
    }
    public function clinicDoctorAppoiemnts(){
        return $this->hasMany('App\models\hospitalAppointment','clinic_id');
    }
}
