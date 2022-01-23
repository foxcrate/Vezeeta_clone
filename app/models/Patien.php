<?php

namespace App\models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PatientResetPasswordNotification;
use App\models\Couples;
use Carbon\Carbon;
class Patien extends Authenticatable
{
        use Notifiable,HasApiTokens;
        public function sendPasswordResetNotification($token){
            $this->notify(new PatientResetPasswordNotification($token));
        }
        protected $fillable = [
            'image',
            'firstName',
            'middleName',
            'lastName',
            'name',
            'BirthDate',
            'gender',
            'email',
            'phoneNumberReal',
            'phoneNumber',
            'password',
            'state',
            'country',
            'job',
            'race',
            'address',
            'role',
            'countryCode',
            'verify',
            'code',
            'is_active',
            'is_donor',
            'provider',
            'provider_id',
            'remember_token',
            'online',
            'hosptail_id',
            'clinic_id',
            'idCode',
            'latitude',
            'longitude',
            'password_confirmation',
            'poients'
        ];
        protected $hidden = [
            'name',
            //'countryCode',
            'role',
            'created_at',
            'updated_at',
            'remember_token',
            'hosptail_id',
            'clinic_id',
            'xray_id',
            'lab_id',
            'is_active',
            'verify',
            'branch_id',
            'pharmacy_id',
            'password',
            'password_confirmation'
        ];

        /* casting online and active */
        protected $casts = [
            'is_active' => 'boolean',
            'online'    => 'boolean',
            'is_donor' => 'boolean',
        ];
        /* -------- relation ------*/
        public function patinets_data(){
            return $this->hasOne('App\models\patientData','patient_id');
        }
        public function Raoucheh(){
            return $this->hasMany('App\models\Raoucheh','patient_id');
        }
        public function patient_analzes(){
            return $this->hasMany('App\models\patient_analzes','patient_id');
        }
        public function patient_rays(){
            return $this->hasMany('App\models\patient_rays','patient_id');
        }
        public function StorageAnalzes(){
            return $this->hasMany('App\models\StorgeAnalazes','patient_id');
        }
        public function StorageRays(){
            return $this->hasMany('App\models\StorgeRays','patient_id');
        }
        public function result(){
            return $this->belongsTo('App\models\Result','patien_id');
        }
        public function hosptail(){
            return $this->belognsTo('App\models\Hosptail','hosptail_id');
        }
        public function clinic(){
            return $this->belognsTo('App\models\Clinic','clinic_id');
        }
        public function branch(){
            return $this->belongsTo('App\models\Branch','branch_id');
        }
        public function xray(){
            return $this->belongsTo('App\models\Xray','xray_id');
        }
        public function lab(){
            return $this->belongsTo('App\models\Lab','xray_id');
        }

        /* -------- relation ------*/

        /* calc patient age */

        public function getAgeAttribute()
        {
            $birth = date('Y/m/d',$this->BirthDate);
            return Carbon::parse($birth)->age;
        }
        /* calc patient age */


    public function pRequest(){
        return $this->hasOne('App\models\PatienRequest','patient_id');
    }
    public function homecare_Request(){
        return $this->hasOne('App\models\HomeCare_Request','patient_id');
    }
    public function chats(){
        return $this->hasMany('App\models\Chat','patient_id');
    }
    public function childern(){
        return $this->hasMany('App\models\Child','patient_id');
    }
    public function faviorates(){
        return $this->hasMany('App\models\Faviorate','patient_id');
    }
    public function checkup(){
        return $this->hasMany('App\models\Checkup','patient_id');
    }
    public function last_checkup(){

        $last_checkup = Checkup::where('patient_id',$this->id)->latest()->first();
        return $last_checkup;

    }
    public function doctor_scudule(){
        return $this->hasMany('App\models\DoctorScudule','patient_id');
    }
    public function test_scudule(){
        return $this->hasMany('App\models\testrScudule','patient_id');
    }
    public function donor(){
        return $this->hasOne('App\models\Donor','patient_id');
    }
    public function medications(){
        return $this->hasMany('App\models\Medication','patient_id');
    }
    public function medicalDevices(){
        return $this->hasMany('App\models\medicalDevices','patient_id');
    }
    public function rate(){
        return $this->hasMany('App\models\RateDoctor','patient_id');
    }


    public function couples(){
        return $this->hasMany('App\models\Couples','patientAccept_id');
    }


    public function Requestcouples(){
        return $this->hasMany('App\models\Couples','patientRequest_id');
    }

    //

    public function myCouples(){

        //return "Alo";
        $my_couples = Couples::where('couples',1)->where('patientAccept_id' , $this->id)->orWhere('couples',1)->where('patientRequest_id' , $this->id)->get();

        //return $this->id;
        return $my_couples;
    }

    public function myCouplesData(){

        //return "Alo";
        $my_accepted_couples_requests = Couples::where('couples',1)->where('patientAccept_id' , $this->id)->orWhere('couples',1)->where('patientRequest_id' , $this->id)->get();
        $my_couples = [];
        //return $my_accepted_couples_requests;

        foreach( $my_accepted_couples_requests as $couple_request){

            if( $this->id == $couple_request->patientAccept->id ){

                array_push($my_couples,$couple_request->patientRequest);

            }else{

                array_push($my_couples,$couple_request->patientAccept);

            }

        }

        //return $this->id;
        return $my_couples;
    }


    public function doctorFamily(){
        return $this->hasOne('App\models\familyDoctor','idCodePatient');
    }
    public function coviedCountry(){
        return $this->hasMany('App\models\covidCountry','patient_id');
    }
    public function coviedPcr(){
        return $this->hasMany('App\models\covidPcr','patient_id');
    }
    public function coviedVac(){
        return $this->hasMany('App\models\covidVac','patient_id');
    }
    public function medactionSender(){
        return $this->hasMany('App\models\medicationRequest','patientIdSender');
    }
    public function medactionAccept(){
        return $this->hasMany('App\models\medicationRequest','patientIdRequest');
    }
    public function medicalSender(){
        return $this->hasMany('App\models\DeviceRequest','patientIdSender');
    }
    public function medicalAccept(){
        return $this->hasMany('App\models\DeviceRequest','patientIdRequest');
    }
    public function donorSender(){
        return $this->hasMany('App\models\requestDonor','patientIdSender');
    }
    public function donorAccept(){
        return $this->hasMany('App\models\requestDonor','patientIdRequest');
    }
    public function rates(){
        return $this->hasMany('App\models\Rate','patient_id');
    }
    public function clupTransaction(){
        return $this->hasMany('App\models\clupTransaction','patient_id');
    }


}
