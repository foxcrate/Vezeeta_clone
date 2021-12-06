<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class needDonor extends Model
{
    protected $fillable = [
        'patient_id',
        'blood',
        'address',
        'details',
        'patientName',
        'fileName',
        'latitude',
        'longitude',
        ];
        public function patient(){
            return $this->belongsTo('App\Models\Patien','patient_id');
        }



    }
