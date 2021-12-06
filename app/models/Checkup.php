<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    protected $fillable = ['temperature','blood_pressure','diabetics','patient_id','date','oxygen'];
   protected $hidden = ['created_at','updated_at'];

    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }
}
