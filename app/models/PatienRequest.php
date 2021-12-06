<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PatienRequest extends Model
{
    protected $fillable = [
    'patient_id',
    'doctor_id',
    'nurse_id',
    'chat_id',
    'is_accept'
    ];
    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }

    public function doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','doctor_id');
    }

    public function nurse(){
        return $this->belongsTo('App\models\Nurse','nurse_id');
    }

    public function chat(){
        return $this->belongsTo('App\models\Chat','chat_id');
    }


    protected $casts = [
        'is_accept' => 'boolean',
    ];
}



