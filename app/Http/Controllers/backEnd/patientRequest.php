<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backEnd\patientRequest\Store;
use App\models\OnlineDoctor;
use App\models\Patien;
use App\models\PatienRequest;
use App\models\Nurse;
use App\models\Chat;
use App\Http\Requests\backEnd\patientRequest\NurseRequest;
class patientRequest extends Controller
{
    /* patient add request */
    public function patient_add_request(Store $request){
        $pRequest = $request->all();
        $patient = Patien::findOrFail($request->patient_id);
        $doctor = OnlineDoctor::findOrFail($request->doctor_id);
        $chatCreate = Chat::create([
            'patient_id' => $patient->id,
            'doctor_id'    => $doctor->id
       ]);
        $pRequestCreate = PatienRequest::create([
            'patient_id'    => $request->patient_id,
            'doctor_id'     => $request->doctor_id,
            'chat_id'       => $chatCreate['id'],
            'is_accept'     => false
        ]);
        if($pRequestCreate){
            return response()->json([
                'status' => true,
                'message' => 'request added',
                'info'     => $pRequestCreate,
            ]);
        }
    }
    /* patient add request */

     /* nurse add request */
     public function nurse_add_request(NurseRequest $request){
        $pRequest = $request->all();
        $patient = Patien::findOrFail($request->patient_id);
        $nurse = Nurse::findOrFail($request->nurse_id);
        $chatCreate = Chat::create([
            'patient_id' => $patient->id,
            'nurse_id'    => $nurse->id,
       ]);
        $pRequestCreate = PatienRequest::create([
            'patient_id'    => $request->patient_id,
            'nurse_id'     => $request->nurse_id,
            'chat_id'       => $chatCreate['id'],
            'is_accept'     => false
        ]);
        if($pRequestCreate){
            return response()->json([
                'status' => true,
                'message' => 'request added',
                'info'     => $pRequestCreate,
            ]);
        }
    }
    /* nurse add request */

    /* doctor decline request */
    public function doctor_decline_request(Request $request){
        $doctor = OnlineDoctor::findOrFail($request->doctor_id);
        $patien_request = PatienRequest::findOrFail($request->request_id);
        $patien_request_delete = $patien_request->delete();
        if($patien_request_delete){
            return response()->json([
                'status' => true,
                'message' => 'request decline'
            ]);
        }
    }
    /* doctor decline request */
    /* nurse decline request */
    public function nurse_decline_request(Request $request){
        $nurse = Nurse::findOrFail($request->nurse_id);
        $patien_request = PatienRequest::findOrFail($request->request_id);
        $patien_request_delete = $patien_request->delete();
        if($patien_request_delete){
            return response()->json([
                'status' => true,
                'message' => 'request decline'
            ]);
        }
    }
    /* nurse decline request */

    /* doctor accept request */
    public function doctor_accept_request(Request $request){
        $doctor = OnlineDoctor::findOrFail($request->doctor_id);
        $patien_request = PatienRequest::findOrFail($request->request_id);
        $patien_request->is_accept = true;
        $patien_request->save();
        return response()->json([
            'status' => true,
            'message'=> 'request accepted',
        ]);
    }
    /* doctor accept request */

    /* doctor accept request */
    public function nurse_accept_request(Request $request){
        $nurse = Nurse::findOrFail($request->nurse_id);
        $patien_request = PatienRequest::findOrFail($request->request_id);
        $patien_request->is_accept = true;
        $patien_request->save();
        return response()->json([
            'status' => true,
            'message'=> 'request accepted',
        ]);
    }
    /* doctor accept request */


    /* show patient profile */
    public function show_patient_profile($id,$patient_id,$request_id,$chat_id){
        $online_doctor = OnlineDoctor::findOrFail($id);
        $patient = Patien::findOrFail($patient_id);
        $patient_request = PatienRequest::findOrFail($request_id);
        $chat = Chat::findOrFail($chat_id);
        return view("backEnd.online-doctor.show_profile_patient",compact('online_doctor','patient','patient_request','chat'));
    }
    /* show patient profile */
    /* nurse show patient profile */
    public function nurse_show_patient_profile($id,$patient_id,$request_id,$chat_id){
        $nurse = Nurse::findOrFail($id);
        $patient = Patien::findOrFail($patient_id);
        $patient_request = PatienRequest::findOrFail($request_id);
        $chat = Chat::findOrFail($chat_id);
        return view("backEnd.nurse.nurse_show_profile_patient",compact('nurse','patient','patient_request','chat'));
    }
    /* nurse show patient profile */

    /* end and delete request */
    public function end_delete_request($id,$request_id){
        $online_doctor = OnlineDoctor::findOrFail($id);
        $patien_request = PatienRequest::findOrFail($request_id);
        $patien_request->delete();
        return redirect()->route('online_doctor.profile',[$online_doctor->id,$patien_request->id]);
    }
    public function nurse_end_delete_request($nurse_id,$id){
        $nurse = Nurse::findOrFail($nurse_id);
        $patien_request = PatienRequest::findOrFail($id);
        $patien_request->delete();
        return redirect()->route('nurse.profile',[$nurse->id,$patien_request->id]);
    }

    public function patient_chat_doctor($id,$doctor_id){
        try{
            $patient = Patien::findOrFail($id);
            $online_doctor = OnlineDoctor::findOrFail($doctor_id);
            $chat = $patient->pRequest->chat;
            return view('backEnd.online-doctor.patient_chat_doctor',compact('patient','online_doctor','chat'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function patient_chat_nurse($id,$nurse_id){
        try{
            $patient = Patien::findOrFail($id);
            $nurse = Nurse::findOrFail($nurse_id);
            $chat = $patient->pRequest->chat;
            return view('backEnd.nurse.patient_chat_nurse',compact('patient','nurse','chat'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }


}
