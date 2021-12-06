<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class rateLab extends Model
{
    protected $fillable = ['rate','lab_id','xray_id','patient_id','servicing','cleanliness','price','receiption'];
    protected $casts = [
        'cleanliness' => 'boolean',
        'nursing'    => 'boolean',
        'pricing' => 'boolean',
        'reciption' => 'boolean',
        'servicing' => 'boolean',
    ];
}
