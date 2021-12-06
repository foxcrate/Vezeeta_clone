<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['patient_id','doctor_id','nurse_id'];
    protected $hidden = ['created_at','updated_id'];

    public function messages(){
        return $this->hasMany('App\models\Message','chat_id');           
    }
    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }
    public function doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','doctor_id');
    }
    public function nurse(){
        return $this->belongsTo('App\models\Nurse','nurse_id');
    }

    public function pRequest(){
        return $this->hasOne('App\models\PatienRequest','chat_id');
    }
}
