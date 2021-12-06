<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Finder extends Model
{
    protected $fillable = [
    'name',
    'phone',
    'address',
    'photo',
    'lat',
    'lng',
    'type'
    ];
}
