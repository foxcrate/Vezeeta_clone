<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $guarded = [];
    protected $fillable = ['doctorRate','doctor_id','patient_id','servicing','cleanliness','nursing','price','receiption'];
    protected $casts = [
        'cleanliness' => 'boolean',
        'nursing'    => 'boolean',
        'pricing' => 'boolean',
        'reciption' => 'boolean',
        'servicing' => 'boolean',
    ];
    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }
    public function doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','doctor_id');
    }
}
