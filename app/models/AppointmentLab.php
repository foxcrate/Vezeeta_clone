<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AppointmentLab extends Model
{
    protected $fillable = [
        'doctor_name',
        'address',
        'phoneNumber',
        'appointments',
        'lab_id',
        'xray_id',
        'latitude',
        'longitude',
        'idCode',
     ];
    protected $casts =['appointments'=>'array'];
    protected $hidden = ['created_at','updated_at'];
    public function lab(){
    return $this->belongsTo('App\models\Lab','lab_id');
    }
    public function xray(){
        return $this->belongsTO('App\models\Xray','xray_id');
    }

}
