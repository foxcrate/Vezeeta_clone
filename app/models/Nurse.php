<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Nurse extends Authenticatable
{
    use Notifiable,HasApiTokens;
    protected $table = 'nurses';
    protected $guard = 'nurse';
    protected $hidden = ['password'];
    protected $fillable = [
    'image',
    'name',
    'phoneNumber',
    'idCode',
    'password',
    'email',
    'information',
    'national_id_front_side',
    'national_id_back_side',
    'national_id',
    'Nationality',
    'is_active',
    'online',
    'countryCode',
    'gender',
    'address',
    'poients',
    'latitude',
    'longitude',
    'is_faviorate'
    ];
      protected $casts = [
        'online'    => 'boolean',
    ];
    public function pRequests()
    {
        return $this->hasMany('App\models\PatienRequest', 'nurse_id');
    }
    public function chats()
    {
        return $this->hasMany('App\models\Chat', 'nurse_id');
    }
    public function faviorates(){
        return $this->hasMany('App\models\Faviorate','patient_id');
    }

    public function clupTransaction(){
        return $this->hasMany('App\models\clupTransaction','nurse_id');
    }
}

