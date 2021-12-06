<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $fillable = [
        'at_birth',
        'two_month',
        'four_month',
        'six_month',
        'nine_month',
        'twelve_month',
        'eighteen_month',
        'twenty_four_month',
        'child_id'
     ];
    protected $hidden = ['created_at','updated_at'];
    protected $casts=[
    'at_birth'=>'array',
    'two_month'=>'array',
    'four_month'=>'array',
    'six_month'=>'array',
    'nine_month'=>'array',
    'twelve_month'=>'array',
    'eighteen_month'=>'array',
    'twenty_four_month'=>'array'
    ];
    public function child(){
        return $this->belongsTo('App\models\Child','child_id');
    }
}
