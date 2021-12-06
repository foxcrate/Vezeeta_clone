<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DoctorScudule extends Model
{
    protected $fillable = [
    'patient_id',
    'patient_name',
    'patient_phone',
    'is_accept',
    'time',
    'appoiment_id'];
    protected $hidden = [
    'created_at',
    'updated_at',
    'is_accept',
    'appoiment_id'
    ];
    protected $casts = [
    'is_accept' => 'boolean',
    ];
    public function appoiment(){
        return $this->belongsTo('App\models\Appointment','appoiment_id');
    }
    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }
}
