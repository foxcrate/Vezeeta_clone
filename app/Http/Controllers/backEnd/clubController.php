<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Lab;
use App\models\Nurse;
use App\models\OnlineDoctor;
use App\models\Patien;
use App\models\Pharmacy;
use App\models\Xray;

class clubController extends Controller
{
    public function patientClub($id){
        try{
            $patient = Patien::with(['clupTransaction'])->find($id);
            if(!$patient){
                return redirect()->back()->with(['error' => 'patient Not Found']);
            }
            return view('backEnd.patien.club.index',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function doctorClub($id){
        try{
            $online_doctor = OnlineDoctor::with(['clupTransaction'])->find($id);
            if(!$online_doctor){
                return redirect()->back()->with(['error' => 'doctor Not Found']);
            }
            return view('backEnd.online-doctor.club.index',compact('online_doctor'));
        }catch(\Exception $ex){

        }

    }
    public function xrayClub($id){
        try{
            $xray = Xray::with(['clupTransaction'])->find($id);
            if(!$xray){
                return redirect()->back()->with(['error' => 'xray Not Found']);
            }
            return view('backEnd.xray.club.index',compact('xray'));
        }catch(\Exception $ex){

        }
    }
    public function labClub($id){
        try{
            $labs = Lab::with(['clupTransaction'])->find($id);
            if(!$labs){
                return redirect()->back()->with(['error' => 'lab Not Found']);
            }
            return view('backEnd.labs.club.index',compact('labs'));
        }catch(\Exception $ex){

        }
    }
    public function pharmacyClub($id){
        try{
            $pharmacy = Pharmacy::with(['clupTransaction'])->find($id);
            if(!$pharmacy){
                return redirect()->back()->with(['error' => 'pharmacy Not Found']);
            }
            return view('backEnd.pharmacy.club.index',compact('pharmacy'));
        }catch(\Exception $ex){

        }
    }

    public function nurseClub($id){
        try{
            $nurse = Nurse::with(['clupTransaction'])->find($id);
            if(!$nurse){
                return redirect()->back()->with(['error' => 'Nurse Not Found']);
            }
            return view('backEnd.nurse.club.index',compact('nurse'));
        }catch(\Exception $ex){

        }
    }
}
