<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class testScudule extends Model
{
    protected $fillable = [
        'patient_id',
        'patient_name',
        'patient_phone',
        'day_name',
        'from',
        'to',
        'time',
        'appoiment_id'];
        protected $hidden = [
        'created_at',
        'updated_at',
        'appoiment_id'
        ];
        public function appoiment(){
            return $this->belongsTo('App\models\Appointment','appoiment_id');
        }
        public function patient(){
            return $this->belongsTo('App\models\Patien','patient_id');
        }
}
