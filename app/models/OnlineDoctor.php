<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OnlineDoctor extends Authenticatable
{
    use HasApiTokens;
    protected $guard = 'online_doctor';//you need to specify the guard for each
    protected $fillable = [
        'image',
        'name',
        'phoneNumber',
        'email',
        'countryCode',
        'password',
        'speciality_id',
        'speciality',
        'degree',
        'degree_image',
        'license_image',
        'license_number',
        'information',
        'national_id_front_side',
        'national_id_back_side',
        'Nationality',
        'idCode',
        'address',
        'latitude',
        'longitude',
        'online',
        'homecare',
        'poients',
        'isHospital',
        'totalRating',
    ];
    protected $hidden = ['password', 'created_at', 'updated_at'];
    protected $casts = [
        'online'    => 'boolean',
        'homecare'  => 'boolean',
        'isHospital' => 'boolean',
    ];
    // special function
    public function special()
    {
        return $this->belongsTo("App\models\DoctorSpecailty", "speciality_id");
    }
    // prequest
    public function pRequests()
    {
        return $this->hasMany('App\models\PatienRequest', 'doctor_id');
    }
    // homecare request
    public function homecare_Request()
    {
        return $this->hasMany('App\models\HomeCare_Request', 'doctor_id');
    }
    // chats function
    public function chats()
    {
        return $this->hasMany('App\models\Chat', 'doctor_id');
    }
    // Raoucheh function
    public function Raoucheh(){
        return $this->hasMany('App\models\Raoucheh','online_doctor_id');
    }
    // analzes function
    public function analzes(){
        return $this->hasMany('App\models\patient_analzes','online_doctor_id');
    }
    // rays function
    public function rays(){
        return $this->hasMany('App\models\patient_rays','online_doctor_id');
    }
    // appointments function
    public function appointments(){
        return $this->hasMany('App\models\Appointment','doctor_id');
    }
    //faviorates function
    public function faviorates(){
        return $this->hasMany('App\models\Faviorate','doctor_id');
    }
    //doctorFamily function
    public function doctorFamily(){
        return $this->hasMany('App\models\familyDoctor','idCodeDoctor');
    }
    //DoctorAppoiemnts function
    public function DoctorAppoiemnts(){
        return $this->hasMany('App\models\hospitalAppointment','doctor_id');
    }
    // rates function
    public function rates(){
        return $this->hasMany('App\models\Rate','doctor_id');
    }
    //clupTransaction function
    public function clupTransaction(){
        return $this->hasMany('App\models\clupTransaction','doctor_id');
    }
}
