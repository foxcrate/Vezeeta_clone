<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class hospitalAppointment extends Model
{
    protected $fillable = [
    'doctor_name',
    'address',
    'special',
    'idCode',
    'phoneNumber',
    'appointments',
    'fees',
    'image',
    'latitude',
    'longitude',
    'doctor_id',
    'hospital_id',
    'clinic_id',
];
    protected $casts = ['appointments' => 'array'];

    public function hosptail(){
        return $this->belongsTo('App\models\Hosptail','hospital_id');
    }

    public function clinic(){
        return $this->belongsTo('App\models\Clinic','clinic_id');
    }

    public function doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','doctor_id');
    }
}
