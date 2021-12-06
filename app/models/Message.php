<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    'body',
    'image',
    'chat_id',
    'user_id'
    ];
    protected $hidden = ['created_at','updated_at'];
    public function chat(){
        return $this->belongsTo('App\models\Chat','chat_id');
    }
    
}
