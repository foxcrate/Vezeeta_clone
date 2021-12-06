<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class covidCountry extends Model
{
    protected $fillable = ['from','to','patient_id'];
    protected $hidden = ['created_at','updated_at'];

    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }

}
