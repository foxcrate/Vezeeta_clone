<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
    'patient_id',
    'blood',
    'latitude',
    'longitude',
    ];
    protected $hidden = ['created_at','updated_at'];
    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }
}
