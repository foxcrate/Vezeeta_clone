<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class HomeCare_Request extends Model
{
    protected $fillable = [
    'patient_id',
    'doctor_id',
    'is_accept'
    ];
    protected $hidden = ['created_at','updated_at'];
    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }
    public function doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','doctor_id');
    }
    protected $casts = [
        'is_accept' => 'boolean',
    ];
}
