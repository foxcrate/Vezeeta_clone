<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class patient_rays extends Model
{

    protected $fillable = [
    'ray_name',
    'patient_id',
    'doctor_id',
    'rocata_id',
    'online_doctor_id',
    'link',
    'date'
    ];
    protected $casts =[
    'link' =>'array',
    'ray_name'=>'array'
    ];
    public function patien(){
    	return $this->belongsTo('App\models\Patien','patient_id');
    }
    public function result(){
    	return $this->hasOne('App\models\Result','ray_id');
    }
    public function doctor(){
        return $this->belongsTo('App\models\Doctor','doctor_id');
    }
    public function rocata(){
        return $this->belongsTo('App\models\Raoucheh','rocata_id');
    }
    public function online_doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','online_doctor_id');
    }
}
