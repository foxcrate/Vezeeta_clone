<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class requestDonor extends Model
{
    protected $fillable = ['accept','patientIdSender','patientIdRequest','donor_id'];
    public function donorForm(){
        return $this->belongsTo('App\models\needDonor','donor_id');
    }
    public function patient(){
        return $this->belongsTo('App\models\Patien','patientIdSender');
    }
public function patientRequest(){
        return $this->belongsTo('App\models\Patien','patientIdRequest');
    }

    
}
