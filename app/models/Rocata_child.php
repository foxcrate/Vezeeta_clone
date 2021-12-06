<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Rocata_child extends Model
{

    protected $fillable = [
    'prescription',
    'medication',
    'child_id',
    'online_doctor_id',
    'jaw_type',
    'jaw_direction',
    'teeth_type',
    'eye_type','date'
    ];
    protected $hidden = ['created_at','updated_at'];
    protected $casts=[
    'medication'=>'array'
    ];
    public function child(){
        return $this->belongsTo('App\models\Child','child_id');
    }
    public function doctor(){
        return $this->belongsTo('App\models\Doctor','doctor_id');
    }
    public  function online_doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','online_doctor_id');
    }
    public function tests_child(){
        return $this->hasMany('App\models\TestChild','rocata_child_id');
    }
}
