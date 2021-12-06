<?php

namespace App\models;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Pharmacy extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,HasApiTokens;
    protected $fillable = [
    'image',
    'pharmacyName',
    'Medical_License_Number',
    'pharmacy_License',
    'phoneNumber',
    'telephone',
    'Hotline',
    'email',
    'password',
    'role',
    'verify',
    'address',
    'countryCode',
    'pharmacy_branch',
    'idCode',
    'latitude',
    'longitude',
    'is_faviorate',
    'password_confirmation'
];

    public function branch(){
    return $this->hasMany('App\models\Branch','pharmacy_id');
    }
    public function faviorates(){
        return $this->hasMany('App\models\Faviorate','patient_id');
    }
    public function clupTransaction(){
        return $this->hasMany('App\models\clupTransaction','pharmacy_id');
    }
 }
