<?php

namespace App\models;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Xray extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,HasApiTokens;
    protected $fillable = [
    'image',
    'xrayName',
    'Medical_License_Number',
    'xray_License',
    'phoneNumber',
    'telephone',
    'Hotline',
    'email',
    'password',
    'is_labs',
    'address',
    'role',
    'countryCode',
    'xray_branch',
    'idCode',
    'latitude',
    'longitude',
    'is_faviorate',
    'password_confirmation',
    'totalRating',
    'poients'
];

    protected $casts=[
    'is_labs' => 'boolean'
    ];
    public function branch(){
        return $this->hasMany('App\models\Branch','xray_id');
    }
    public function patiens(){
        return $this->hasMany('App\models\Patien','xray_id');
    }
    public function faviorates(){
        return $this->hasMany('App\models\Faviorate','patient_id');
    }
    public function appointments_lab(){
        return $this->hasMany('App\models\AppointmentLab','xray_id');
    }

    public function clupTransaction(){
        return $this->hasMany('App\models\clupTransaction','xray_id');
    }

}
