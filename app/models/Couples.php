<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Couples extends Model
{
    protected $fillable = ['patientAccept_id','patientRequest_id','couples'];

    // public function patient(){
    //     return $this->belongsTo('App\models\Patien','patientRequest_id');
    // }

    public function patientAccepted(){
        return $this->belongsTo('App\models\Patien','patientAccept_id');
    }


    // public function patientRequest(){
    //     return $this->belongsTo('App\models\Patien','patientAccept_id');
    // }

    public function patientRequest(){
        return $this->belongsTo('App\models\Patien','patientRequest_id');
    }

    public function alo(){
        return $this->id;
    }

    protected $casts = [
        'couples' => 'boolean',
    ];
}
