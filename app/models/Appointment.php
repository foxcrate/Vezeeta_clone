<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_name',
        'address',
        'special',
        'phoneNumber',
        'appointments',
        'wating',
        'fees',
        'doctor_id',
        'latitude',
        'longitude',
        'idCode'
    ];
    protected $casts =['appointments'=>'array'];
    protected $hidden = ['created_at','updated_at'];
    public function doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','doctor_id');
    }
    public function doctor_scudule(){
        return $this->hasMany('App\models\DoctorScudule','appoiment_id');
    }
    public function test_scudule(){
        return $this->hasMany('App\models\testScudule','appoiment_id');
    }
}
