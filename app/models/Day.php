<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at','updated_at'];
}
