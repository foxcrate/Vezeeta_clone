<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Doctor extends Authenticatable
{
    protected $fillable = [
        'image',
        'name',
        'phoneNumber',
        'IdCode',
        'countryCode',
        'password',
        'Primary_Speciality',
        'degree',
        'information',
        'national_id_front_side',
        'national_id_back_side',
        'national_id',
        'branch',
        'hosptail_id',
        'Nationality',
        'clinic_id'];
    protected $hidden = ['pivot'];
    public function hosptail(){
        return $this->belongsTo('App\models\Hosptail','hosptail_id');
    }
    public function clinic(){
        return $this->belongsTo('App\models\Clinic','clinic_id');
    }
    public function rocatas(){
        return $this->hasMany('App\models\Raoucheh','doctor_id');
    }
    public function analzes(){
        return $this->hasMany('App\models\patient_analzes','doctor_id');
    }
    public function rays(){
        return $this->hasMany('App\models\patient_rays','doctor_id');
    }
    public function branch(){
        return $this->belongsToMany('App\models\Branch','doctor_branch','doctor_id','branch_id');
    }

    public function rocatas_child(){
        return $this->hasMany('App\models\Rocata_child','doctor_id');
    }
    public function tests_child(){
        return $this->hasMany('App\models\TestChild','doctor_id');
    }
    public function ray_child(){
        return $this->hasMany('App\models\RayChild','doctor_id');
    }
}
