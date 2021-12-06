<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\models\Patien;
use App\models\Hosptail;
use App\models\Clinic;
use App\models\Xray;
use App\models\Lab;
use App\models\Pharmacy;
use DB;
class socialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        return $this->loginUser($getInfo);
    }

    private function loginUser($getInfo){
        $useasPatienr = Patien::where('email', $getInfo->email)->first();
        $useasHosptail = Hosptail::where('email', $getInfo->email)->first();
        $useasClinic = Clinic::where('email', $getInfo->email)->first();
        $useasXray = Xray::where('email', $getInfo->email)->first();
        $useasLab = Lab::where('email', $getInfo->email)->first();
        $userasPharmacy = Pharmacy::where('email', $getInfo->email)->first();
       if($useasPatienr){
          auth()->guard('patien')->login($useasPatienr);
            return redirect()->route('patien-profile',$useasPatienr->id);
       }
       else if($useasHosptail){
            auth()->guard('hosptail')->login($useasHosptail);
            if(auth()->guard('hosptail')->check()){
                 return redirect()->route('hosptail.profile',$useasHosptail->id);
            }
       }
       else if($useasClinic){
            auth()->guard('clinic')->login($useasClinic);
             if(auth()->guard('clinic')->check()){
                return redirect()->route('clinic.profile',$useasClinic->id);
            }
       }
       else if($useasXray){
            auth()->guard('xray')->login($useasXray);
             if(auth()->guard('xray')->check()){
                 return redirect()->route('xray.profile',$useasXray->id);
            }
       }
       else if($useasLab){
            auth()->guard('labs')->login($useasLab);
             if(auth()->guard('labs')->check()){
                 return redirect()->route('labs.profile',$useasLab->id);
            }
       }
       else if($userasPharmacy){
            auth()->guard('pharmacy')->login($userasPharmacy);
              if(auth()->guard('pharmacy')->check()){
                 return redirect()->route('pharmacy.profile',$userasPharmacy->id);

            }
       }else{
           return redirect()->route('indexRegister');
       }

        if($useasPatienr){
            auth()->guard('patien')->login($useasPatienr);
            return redirect()->route('patien-profile',$useasPatienr->id);
        }
        else if($useasHosptail){
            auth()->guard('hosptail')->login($useasHosptail);
            if(auth()->guard('hosptail')->check()){
                return redirect()->route('hosptail.profile',$useasHosptail->id);
            }
        }
        else if($useasClinic){
            auth()->guard('clinic')->login($useasClinic);
            if(auth()->guard('clinic')->check()){
                return redirect()->route('clinic.profile',$useasClinic->id);
            }
        }
        else if($useasXray){
            auth()->guard('xray')->login($useasXray);
            if(auth()->guard('xray')->check()){
                return redirect()->route('xray.profile',$useasXray->id);
            }
        }
        else if($useasLab){
            auth()->guard('labs')->login($useasLab);
            if(auth()->guard('labs')->check()){
                return redirect()->route('labs.profile',$useasLab->id);
            }
        }
        else if($userasPharmacy){
            auth()->guard('pharmacy')->login($userasPharmacy);
            if(auth()->guard('pharmacy')->check()){
                return redirect()->route('pharmacy.profile',$userasPharmacy->id);
            }
        }else{
            return redirect()->route('indexRegister');
        }

    }
}
