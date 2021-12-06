<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Couples extends Model
{
    protected $fillable = ['patientAccept_id','patientRequest_id','couples'];
    public function patient(){
        return $this->belongsTo('App\models\Patien','patientRequest_id');
    }
    public function patientRequest(){
        return $this->belongsTo('App\models\Patien','patientAccept_id');
    }
    protected $casts = [
        'couples' => 'boolean',
    ];
}
