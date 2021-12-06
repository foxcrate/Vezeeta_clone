<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class familyDoctor extends Model
{
    protected $fillable = [
        'idCodeDoctor',
        'idCodePatient',
        'is_accept',
        ];
        protected $casts  = ['is_accept' => 'boolean'];
        public function patient(){
            return $this->belongsTo('App\models\Patien','idCodePatient');
        }
        public function doctor(){
            return $this->belongsTo('App\models\OnlineDoctor','idCodeDoctor');
        }
}
