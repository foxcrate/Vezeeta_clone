<?php

namespace App\models;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lab extends Authenticatable implements MustVerifyEmail
{    use Notifiable,HasApiTokens;

    protected $fillable = [
        'image',
        'labsName',
        'Medical_License_Number',
        'labs_License',
        'phoneNumber',
        'telephone',
        'Hotline',
        'email',
        'password',
        'password_confirmation',
        'role',
        'is_xray',
        'verify',
        'address',
        'countryCode',
        'labs_branch',
        'idCode',
        'latitude',
        'longitude',
        'is_faviorate',
        'password_confirmation',
        'totalRating',
        'point',
    ];
    protected $casts=['is_xray' => 'boolean'];

    public function branch(){
        return $this->hasMany('App\models\Branch','lab_id');
    }
    public function patiens(){
        return $this->hasMany('App\models\Patien','xray_id');
    }
    public function faviorates(){
        return $this->hasMany('App\models\Faviorate','patient_id');
    }

    public function appointments_lab(){
        return $this->hasMany('App\models\AppointmentLab','lab_id');
    }

    public function clupTransaction(){
        return $this->hasMany('App\models\clupTransaction','lab_id');
    }
}
