<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Faviorate extends Model
{
    protected $fillable = [
    'name',
    'idCode',
    'address',
    'type',
    'latitude',
    'longitude',
    'doctor_id',
    'nurse_id',
    'lab_id',
    'xray_id',
    'pharmacy_id',
    'patient_id',
    'image',
    'phoneNumber',
    ];
    protected $hidden = ['created_at','updated_at'];

    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }
    public function doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','doctor_id');
    }
    public function nurse(){
        return $this->belongsTo('App\models\Nurse','nurse_id');
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
}
