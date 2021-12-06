<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
    'name',
    'test_id',
    'ray_id',
    'patien_id',
    'child_id',
    'test_child_id',
    'ray_child_id'
    ];
    public function test(){
        return $this->belongsTo('App\models\patient_analzes','test_id');
    }
    public function ray(){
        return $this->belongsTo('App\models\patient_rays','ray_id');
    }
    public function ray_child(){
        return $this->belongsTo('App\models\RayChild','ray_child_id');
    }
    public function test_child(){
        return $this->belongsTo('App\models\TestChild','test_child_id');
    }
    public function patiens(){
        return $this->hasMany('App\models\Patien','patien_id');
    }
    public function children(){
        return $this->hasMany('App\models\Child','child_id');
    }
}
