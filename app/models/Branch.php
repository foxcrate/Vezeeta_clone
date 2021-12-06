<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Branch extends Authenticatable
{
    protected $fillable = [
        'Name',
        'address',
        'phoneNumber',
        'password',
        'is_xray',
        'is_lab',
        'is_pharmacy',
        'hosptail_id',
        'clinic_id',
        'xray_id',
        'lab_id',
        'pharmacy_id'
    ];
    protected $hidden = [
    'pivot',
    'hosptail_id',
    'clinic_id',
    'xray_id',
    'lab_id',
    'pharmacy_id',
    'is_xray',
    'is_lab',
    'is_pharmacy',
    'password'
    ];

    public function hosptail(){
        return $this->belongsTo('App\models\Hosptail','hosptail_id');
    }
    public function clinic(){
        return $this->belongsTo('App\models\Clinic','clinic_id');
    }
    public function xray(){
        return $this->belongsTo('App\models\Xray','xray_id');
    }
    public function lab(){
        return $this->belongsTo('App\models\Lab','lab_id');
    }
    public function pharmacy(){
        return $this->belongsTo('App\models\Pharmacy','pharmacy_id');
    }
    // public function doctor(){
    //     return $this->belongsToMany('App\models\Doctor','doctor_branch','branch_id','doctor_id');
    // }
    public function patiens(){
        return $this->hasMany('App\models\Patien','branch_id');
    }
}
