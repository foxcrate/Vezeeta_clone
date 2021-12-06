<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class patient_analzes extends Model
{
    protected $fillable = [
    'test_name',
    'patient_id',
    'doctor_id',
    'rocata_id',
    'online_doctor_id',
    'date',
    'link'
    ];
    protected $casts = [
    'test_name'=>'array',
    'link' =>'array'
    ];
    public function patien(){
    	return $this->belongsTo('App\models\Patien','patient_id');
    }
    // public function result(){
    // 	return $this->hasOne('App\models\Result','test_id');
    // }
    // public function doctor(){
    //     return $this->belongsTo('App\models\Doctor','doctor_id');
    // }
    public function rocata(){
        return $this->belongsTo('App\models\Raoucheh','rocata_id');
    }
    public function online_doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','online_doctor_id');
    }

}
