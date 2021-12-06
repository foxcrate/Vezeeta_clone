<?php

namespace App\Http\Controllers\backEnd;

use App\models\Patien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Lab;
use App\models\Nurse;
use App\models\OnlineDoctor;
use App\models\Pharmacy;
use App\models\Xray;

class qrController extends Controller
{
    public function index($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.qr.index',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function xrayQr($id){
        try{
            $xray = Xray::findOrFail($id);
            return view('backEnd.qr.xrayQr',compact('xray'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function labQr($id){
        try{
            $labs = Lab::findOrFail($id);
            return view('backEnd.qr.labyQr',compact('labs'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function pharmacyQr($id){
        // try{
            $pharmacy = Pharmacy::findOrFail($id);
            return view('backEnd.qr.pharmacyQr',compact('pharmacy'));
        // }catch(\Exception $ex){
        //     return redirect()->back()->with(['error' => 'problem']);
        // }
    }

    public function doctorQr($id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            return view('backEnd.qr.doctorQr',compact('online_doctor'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function nurseQr($id){
        try{
            $nurse = Nurse::findOrFail($id);
            return view('backEnd.qr.nurseQr',compact('nurse'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
}
