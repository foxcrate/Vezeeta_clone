<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class patientReshouta extends Model
{
    protected $fillable = ['idpatient','idXray','link','information','idLab'];
}
