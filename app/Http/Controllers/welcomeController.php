<?php

namespace App\Http\Controllers;

use App\models\DoctorSpecailty;
use App\models\Hosptail;
use Illuminate\Http\Request;
use App\models\Patien;
use Illuminate\Support\Facades\Auth;
class welcomeController extends Controller
{
    /* get clup page */
    public function getClup($account,$id){
        if(Auth::guard('patien')){
            $patient = Patien::find($id);
            return view('anyPages.clup',compact('patient'));
        }elseif(Auth::guard('hosptail')){
            $hosptail = Hosptail::find($id);
            return view('anyPages.clup',compact('hosptail'));
        }elseif(Auth::guard('clinic')){
            return view('anyPages.clup',compact('clinic'));
        }elseif(Auth::guard('xray')){
            return view('anyPages.clup',compact('xray'));
        }elseif(Auth::guard('labs')){
            return view('anyPages.clup',compact('labs'));
        }
        elseif(Auth::guard('pharmacy')){
            return view('anyPages.clup',compact('pharmacy'));
        }
    }
    /* get clup page */

    public function getInsurance($account,$id){
        if(Auth::guard('patien')){
            $patient = Patien::find($id);
            return view('anyPages.Insurance',compact('patient'));
        }elseif(Auth::guard('hosptail')){
            $hosptail = Hosptail::find($id);
            return view('anyPages.Insurance',compact('hosptail'));
        }elseif(Auth::guard('clinic')){
            return view('anyPages.Insurance',compact('clinic'));
        }elseif(Auth::guard('xray')){
            return view('anyPages.Insurance',compact('xray'));
        }elseif(Auth::guard('labs')){
            return view('anyPages.Insurance',compact('labs'));
        }
        elseif(Auth::guard('pharmacy')){
            return view('anyPages.Insurance',compact('pharmacy'));
        }
    }
    public function getOnline($account,$id){
        if(Auth::guard('patien')){
            $doctorSp = DoctorSpecailty::with('onlineDoctor')->get();
            $patient = Patien::find($id);
            return view('anyPages.online',compact('patient','doctorSp'));
        }elseif(Auth::guard('hosptail')){
            $hosptail = Hosptail::find($id);
            return view('anyPages.online',compact('hosptail'));
        }elseif(Auth::guard('clinic')){
            return view('anyPages.online',compact('clinic'));
        }elseif(Auth::guard('xray')){
            return view('anyPages.online',compact('xray'));
        }elseif(Auth::guard('labs')){
            return view('anyPages.online',compact('labs'));
        }
        elseif(Auth::guard('pharmacy')){
            return view('anyPages.online',compact('pharmacy'));
        }
    }
    public function getQr($account,$id){
        if(Auth::guard('patien')){
            $patient = Patien::find($id);
            return view('anyPages.qr',compact('patient'));
        }elseif(Auth::guard('hosptail')){
            $hosptail = Hosptail::find($id);
            return view('anyPages.qr',compact('hosptail'));
        }elseif(Auth::guard('clinic')){
            return view('anyPages.qr',compact('clinic'));
        }elseif(Auth::guard('xray')){
            return view('anyPages.qr',compact('xray'));
        }elseif(Auth::guard('labs')){
            return view('anyPages.qr',compact('labs'));
        }
        elseif(Auth::guard('pharmacy')){
            return view('anyPages.qr',compact('pharmacy'));
        }
    }
    public function getShare($account,$id){
        if(Auth::guard('patien')){
            $patient = Patien::find($id);
            return view('anyPages.share',compact('patient'));
        }elseif(Auth::guard('hosptail')){
            $hosptail = Hosptail::find($id);
            return view('anyPages.share',compact('hosptail'));
        }elseif(Auth::guard('clinic')){
            return view('anyPages.share',compact('clinic'));
        }elseif(Auth::guard('xray')){
            return view('anyPages.share',compact('xray'));
        }elseif(Auth::guard('labs')){
            return view('anyPages.share',compact('labs'));
        }
        elseif(Auth::guard('pharmacy')){
            return view('anyPages.share',compact('pharmacy'));
        }
    }
    /* get privacy policy [sidebar] */
    public function getPrivacy($account,$id){
        if(Auth::guard('patien')){
            $patient = Patien::find($id);
            return view('anyPages.getPrivacy',compact('patient'));
        }elseif(Auth::guard('hosptail')){
            $hosptail = Hosptail::find($id);
            return view('anyPages.getPrivacy',compact('hosptail'));
        }elseif(Auth::guard('clinic')){
            return view('anyPages.getPrivacy',compact('clinic'));
        }elseif(Auth::guard('xray')){
            return view('anyPages.getPrivacy',compact('xray'));
        }elseif(Auth::guard('labs')){
            return view('anyPages.getPrivacy',compact('labs'));
        }
        elseif(Auth::guard('pharmacy')){
            return view('anyPages.getPrivacy',compact('pharmacy'));
        }
    }
    /* get privacy policy [sidebar] */
    /* get privacy policy [register] */
    public function getPrivacyRegister(){
        return view('anyPages.getPrivacyRegister');
    }
    /* get privacy policy [register] */
}
