<?php

namespace App\Http\Controllers\backEnd;

use App\models\HomeCare_Request;
use Illuminate\Http\Request;
use App\models\Patien;
use App\models\OnlineDoctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\bakeEnd\homecare\Store;
use App\models\Nurse;

class homecareController extends Controller
{
    //Store
    public function addRequest(Request $request){
        //return $request;

        $this->validate($request, [
            'patient_id'    => 'required|exists:patiens,id',
            'doctor_id'     => 'required|exists:online_doctors,id',
        ]);
        //return "Alo";
        $patient = Patien::findOrFail($request->patient_id);
        $doctor = OnlineDoctor::findOrFail($request->doctor_id);
        //return "Alo 1";
        $homecareRequest = HomeCare_Request::create([
            'patient_id'    => $request->patient_id,
            'doctor_id'     => $request->doctor_id,
            'is_accept'     => false
        ]);
        //return "Alo 2";
        if($homecareRequest){
            return response()->json([
                'status' => true,
                'message' => 'request added',
                'info'     => $homecareRequest,
            ]);
        }
    }
    public function acceptRequest(Request $request){
        //return $request;
        $doctor = OnlineDoctor::findOrFail($request->doctor_id);
        $homecareRequest = HomeCare_Request::findOrFail($request->homecare_request_id);
        $homecareRequest->is_accept = true;
        $homecareRequest->save();
        return response()->json([
            'status' => true,
            'message'=> 'request accepted',
        ]);
    }
    public function declineRequest(Request $request){
        $doctor = OnlineDoctor::findOrFail($request->doctor_id);
        $homecareRequest = HomeCare_Request::findOrFail($request->homecare_request_id);
        $homecareRequest_delete = $homecareRequest->delete();
        if($homecareRequest_delete){
            return response()->json([
                'status' => true,
                'message' => 'request decline'
            ]);
        }
    }

    public function patientSearchNurse($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.homecare.patientSearchNurse',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function searchNurse($id,Request $request){
        try{
            $patient = Patien::findOrFail($id);
            $nurses = Nurse::get();
            return view('backEnd.patien.homecare.getNurse',compact('nurses','patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }


}
