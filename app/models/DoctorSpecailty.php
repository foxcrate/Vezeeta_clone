<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DoctorSpecailty extends Model
{
    protected $fillable = ['name'];

    public function onlineDoctor(){
        return $this->hasMany("App\models\OnlineDoctor","speciality_id");
    }
}
