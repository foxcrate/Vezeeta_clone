<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Raoucheh extends Model
{
    protected $fillable = [
        'prescription',
        'weight',
        'temperature',
        'blood_pressure',
        'diabetics',
        'jaw_type',
        'jaw_direction',
        'teeth_type',
        'eye_type',
        'medication',
        'patient_id',
        'doctor_id',
        'online_doctor_id',
        'date',
      ];
    protected $casts=[
        'medication'=>'array'
     ];
    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
     }
    public  function doctor(){
        return $this->belongsTo('App\models\Doctor','doctor_id');
     }

    public function patient_analzes(){
        return $this->hasMany('App\models\patient_analzes','rocata_id');
     }
    public function patient_rays(){
        return $this->hasMany('App\models\patient_rays','rocata_id');
     }
    public  function online_doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','online_doctor_id');
     }
}
