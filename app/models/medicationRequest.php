<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class medicationRequest extends Model
{
    protected $fillable = ['accept','patientIdSender','patientIdRequest','medication_id','quantity'];
         protected $casts = [
    'accept' => 'boolean',
    ];
    public function donorForm(){
        return $this->belongsTo('App\models\Medication','medication_id');
    }
    public function patient(){
        return $this->belongsTo('App\models\Patien','patientIdSender');
    }
    public function patientRequest(){
        return $this->belongsTo('App\models\Patien','patientIdRequest');
    }
}
