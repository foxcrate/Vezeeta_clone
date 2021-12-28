<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class patientData extends Model
{
    protected $fillable = [
        'width',
        'height',
        'width_type',
        'blood',
        'agree_name',
        'allergi_data',
        'surgery_data',
        'medication_name',
        'rocata_file',
        'rays_file',
        'analzes_file',
        'colonscopy',
        'colonscopy_data',
        'mammogram',
        'mammogram_data',
        'prc',
        'prc_data',
        'smoking',
        'mother',
        'other_mother',
        'father',
        'other_father',
        'Period_Cycle',
        'Abotion',
        'wife_Contraceptive',
        'mother_pregnency',
        'deliveries',
        'complicetion',
        'online',
        'single_Period_Cycle',
        'patient_id',
    ];
        protected $casts = [
        'agree_name' => 'array',
        'allergi_data' => 'array',
        'surgery_data' => 'array',
        'medication_name' =>'array',
        'smoking' => 'array',
        'rocata_file'    => 'array',
        'rays_file' =>'array',
        'analzes_file' =>'array',
        'mother' => 'array',
        'father' => 'array',
        ];
    public function patient(){
        return $this->belongsTo("App\models\Patien","patient_id");
    }


}
