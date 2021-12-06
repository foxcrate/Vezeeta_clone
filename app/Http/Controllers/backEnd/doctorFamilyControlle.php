<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\OnlineDoctor;
use App\models\Patien;
use App\models\familyDoctor;
use RealRashid\SweetAlert\Facades\Alert;
class doctorFamilyControlle extends Controller
{
    public function index($id){
        try{
            $doctors = OnlineDoctor::where('speciality_id',1)->get();
            $patient = Patien::findOrFail($id);
            return view('backEnd.doctorfamily.index',compact('patient','doctors'));
        }catch(\Exception $ex){

        }
    }

    public function searchDoctor(Request $request){
        try{
            $doctorSearch = OnlineDoctor::where('name',$request->search)->where('speciality_id',1)->first();
            if(!$doctorSearch){
                Alert::error('Error','Doctor Not Found');
                return redirect()->back();
            }
            return redirect()->back()->with(['data' => $doctorSearch]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'Problem']);
        }
    }

    public function addRequestDoctor(Request $request){
        try{
            $doctorFamilyCreate = familyDoctor::create([
                'idCodeDoctor'  => $request->doctor_id,
                'idCodePatient' => $request->patient_id,
                'is_accept'     => false
            ]);
            return response()->json([
                'data'  => $doctorFamilyCreate,
                'status'    => true
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function acceptRequestDoctor(Request $request){
        try{
            $familyDoctor = familyDoctor::where('idCodeDoctor',$request->doctor_id)->where('idCodePatient',$request->patient_id)->first();
            $familyDoctor->is_accept = true;
            $familyDoctor->save();
            return response()->json([
                'data' => $familyDoctor,
                'status'    => true
            ]);
        }catch(\Exception $ex){

        }
    }
    public function declineRequestDoctor(Request $request){
        try{
            $familyDoctor = familyDoctor::where('idCodeDoctor',$request->doctor_id)->where('idCodePatient',$request->patient_id)->first();
            $familyDoctor->delete();
            return response()->json([
                'data'  => $familyDoctor,
                'status'    => true
            ]);
        }catch(\Exception $ex){

        }
    }
    public function declinePatientRequest(Request $request){
       try{
            $familyDoctor = familyDoctor::where('idCodePatient',$request->patient_id)->where('idCodeDoctor',$request->doctor_id)->first();
            $familyDoctor->delete();
            return response()->json([
                'data'  => $familyDoctor,
                'status'    => true
            ]);
        }catch(\Exception $ex){

        }
    }
}
