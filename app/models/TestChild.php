<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;
class TestChild extends Model
{
    protected $fillable = [
    'test_name',
    'child_id',
    'doctor_id',
    'rocata_child_id',
    'online_doctor_id',
    'date',
    'link'
    ];
    protected $hidden = ['created_at','updated_at'];
    protected $casts =[
    'test_name'=>'array',
    'link' =>'array'
    ];
    public function child(){
        return $this->belongsTo('App\models\Child','child_id');
    }
    public function doctor(){
        return $this->belongsTo('App\models\Doctor','doctor_id');
    }
    public function rocata_child(){
        return $this->belongsTo('App\models\Rocata_child','rocata_child_id');
    }
    // public function result(){
    // 	return $this->hasOne('App\models\Result','test_child_id');
    // }
    public function online_doctor(){
        return $this->belongsTo('App\models\OnlineDoctor','online_doctor_id');
    }
}
