<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class clupTransaction extends Model
{
    protected $guarded = [];
    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }
    public function doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','doctor_id');
    }
    public function xray(){
        return $this->belongsTo('App\models\Xray','xray_id');
    }
    public function lab(){
        return $this->belongsTo('App\models\Lab','lab_id');
    }
    public function pharmacy(){
        return $this->belongsTo('App\models\Pharmacy','pharmacy_id');
    }
    public function nurse(){
        return $this->belongsTo('App\models\Nurse','nurse_id');
    }
}
