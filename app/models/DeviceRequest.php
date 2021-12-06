<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DeviceRequest extends Model
{
    protected $fillable = ['accept','patientIdSender','patientIdRequest','device_id','quantity'];
    
    public function donorForm(){
        return $this->belongsTo('App\models\medicalDevices','device_id');
    }
    public function patient(){
        return $this->belongsTo('App\models\Patien','patientIdSender');
    }
    public function patientRequest(){
        return $this->belongsTo('App\models\Patien','patientIdRequest');
    }
}
