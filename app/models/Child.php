<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Child extends Model
{
    protected $fillable = [
        'child_name',
        'image',
        'birthDay',
        'gender',
        'weight',
        'weight_type',
        'height',
        'blood',
        'disease',
        'Surgeries',
        'allergy',
        'medication',
        'fatherdisease',
        'motherdisease',
        'patient_id'
    ];
    protected $casts = [
        'allergy'   => 'array',
        'Surgeries' => 'array',
        'medication'    => 'array',
    ];
    protected $hidden = ['created_at','updated_at'];

    public function patient(){
        return $this->belongsTo('App\models\Patien','patient_id');
    }
    public function rocatas(){
        return $this->hasMany('App\models\Rocata_child','child_id');
    }
    public function test_child(){
        return $this->hasMany('App\models\TestChild','child_id');
    }
    public function ray_child(){
        return $this->hasMany('App\models\RayChild','child_id');
    }

    public function result(){
        return $this->belongsTo('App\models\Result','child_id');
    }
    public function Vaccination(){
        return $this->hasOne('App\models\Vaccination','child_id');
    }

    public function getCalcAgeYearAttribute(){
        $birth = date('Y/m/d',$this->birthDay);
        return Carbon::createFromDate($birth)->diff(Carbon::now())->format('%y');
    }
    public function getCalcAgeMonthAttribute(){
        $birth = date('Y/m/d',$this->birthDay);
        return Carbon::createFromDate($birth)->diff(Carbon::now())->format('%m');
    }
    public function getCalcAgeDayAttribute(){
        $birth = date('Y/m/d',$this->birthDay);
        return Carbon::createFromDate($birth)->diff(Carbon::now())->format('%d');
    }

}
