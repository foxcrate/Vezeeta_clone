<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

    protected $fillable = ['banner'];
    protected $hidden = ['created_at','updated_at'];
}
