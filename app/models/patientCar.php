<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class patientCar extends Model
{
    protected $fillable = [
    'ampulanceType',
    'patientName',
    'phoneNumber',
    'date',
    'address',
    'addressDist',
    'carType',
    'PurposeOfTheTipe',
    'requireQues',
    'patient_id'];
    protected $hidden = ['created_at','updated_at'];
}
