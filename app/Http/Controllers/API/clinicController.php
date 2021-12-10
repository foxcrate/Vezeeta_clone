<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\hospitalRequest;
use App\models\Clinic;
use App\models\OnlineDoctor;
use App\models\hospitalAppointment;
use Intervention\Image\Facades\Image;
use Auth;
class clinicController extends Controller
{
    public function register1(Request $request) {
        //return "Alo";
        $hospitalRequest = $request -> all();
        $validator = Validator::make($hospitalRequest, [
            'image' => 'max:20000',
            'clinicName' => 'required',
            'Primary_Speciality' => '',
            'Medical_License_Number' => 'required',
            'Clinic_License' => 'max:1024',
            'idCode' => 'required|unique:clinics',
            'telephone' => '',
            'Hotline' => '',
            'email' => 'email|unique:clinics',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|sometimes|required_with:password',
            'address' => 'required',
            'role' => '',
            'latitude' => '',
            'longitude' => ''
        ]);
        if ($validator -> fails()) {
            return response([
                'error' => $validator -> errors(),
                'Validation Error'
            ],400);
        }
        $hospitalRequest['password'] = bcrypt($request -> password);
        $hospitalRequest['phoneNumber'] = str_replace(
            'H',
            '+',
            $hospitalRequest['idCode']
        );
        $hospitalRequest['role'] = 'clinic';
        $hospitalRequest['is_active'] = true;
        $hospitalRequest['clinic_labs'] = false;
        $hospitalRequest['clinic_xray'] = false;
        $hospitalRequest['clinic_pharmacy'] = false;
        $hospitalCreate = Clinic::create($hospitalRequest);
        $success['token'] = $hospitalCreate -> createToken('MyApp') -> accessToken;
        if ($hospitalCreate) {
            return response() -> json([
                'data' => $hospitalCreate,
                'message' => 'success',
                'token' => $success['token']
            ]);
        }
    }

    // public function loginDoctor(){
    //     return "Alo";
    // }

    public function uploadImage(Request $request) {
        $hospitalRequest = $request -> image;
        $image = $request -> file('image');
        $input = $hospitalRequest = time().'.'.$image -> getClientOriginalExtension();
        $destinationPath = public_path('uploads/hosptail/');
        $img = Image::make($image -> getRealPath());
        $img -> resize(100, 100, function ($constraint) {
            $constraint -> aspectRatio();
        }) -> save($destinationPath.'/'.$hospitalRequest);
        return response() -> json([
            'data' => asset('/uploads/hosptail/'.$input),
            'status' => true,
            'message' => 'success Message'
        ]);
    }
    public function getAll() {
        $hosptails = Clinic::count();
        if ($hosptails) {
            $hosptail = Clinic::paginate(20);
            return response([
                'data' => $hosptail,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed'],400);
        }
    }
    public function login() {
        if (Auth::guard('clinic') -> attempt([
            'idCode' => request('idCode'),
            'password' => request('password')
        ])) {
            $user = Auth::guard('clinic') -> user();
            $success['token'] = $user -> createToken('MyApp') -> accessToken;
            return response() -> json([
                'data' => $user,
                'message' => 'success',
                'token' => $success['token']
            ]);
        } else {
            return response() -> json(['error' => 'Unauthorised'], 401);
        }
    }
    public function confirm_password(Request $request) {
        $patient = Clinic::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $patient -> password = bcrypt($request -> password);
            $patient -> update();
            return response() -> json([
                'data' => $patient,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function searchClinic(Request $request) {
        $hospital = Clinic::where('idCode', $request -> idCode) -> count();
        if ($hospital) {
            $hospital = Clinic::where('idCode', $request -> idCode) -> get();
            return response() -> json([
                'data' => $hospital,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'failed'],400);
    }
    public function doctorClinic(Request $request){
        $clinic = Clinic::where('idCode',$request->id)->first();
        if($clinic){
            $doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
            if($doctor){
                $add = hospitalAppointment::where('doctor_id',$doctor->id)->where('clinic_id',$clinic->id)->first();
                if(!$add){
               $add = hospitalAppointment::create([
                'doctor_name' => $doctor->name,
                'idCode' => $request->idCode,
                'address' => $clinic->address,
                'special' => $doctor->speciality,
                'image'=>$doctor->image,
                'phoneNumber' => $doctor->phoneNumber,
                'latitude' =>$clinic->latitude,
                'longitude' =>$clinic->longitude,
                'doctor_id' => $doctor->id,
                'clinic_id' => $clinic->id,
               ]);
               return response()->json([
               'data' => $add,
               'message' => 'success',
               ]);
                }
                return response()->json([
                    'message' => 'exist',
                ]);
            }
        }
               return response()->json([
                'message' => 'faild',
               ],400);
    }
    public function updateDoctor(Request $request){
        $hospital = Clinic::where('idCode',$request->id)->first();
        if($hospital){
            $doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
            if($doctor){
                $update= hospitalAppointment::where('clinic_id',$hospital->id)
                ->where('doctor_id',$doctor->id)->update([
                 'appointments' => json_encode($request->appointments),
                 'fees' => $request->fees,
                ]);
                return response()->json([
                 'data' => $update,
                 'message' => 'success'
                ]);
            }}
            return response()->json([
            'message' => 'faild' ,
            ],400);
    }
    public function getUpdateDoctor(Request $request){
        $hospital = Clinic::where('idCode',$request->id)->first();
        if($hospital){
            $doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
            if($doctor){
                $update= hospitalAppointment::where('clinic_id',$hospital->id)
                ->where('doctor_id',$doctor->id)->count();
                if($update){
                    $update= hospitalAppointment::where('clinic_id',$hospital->id)
                    ->where('doctor_id',$doctor->id)->get();
                return response()->json([
                 'data' => $update,
                 'message' => 'success'
                ]);
            }}}
            return response()->json([
            'message' => 'faild' ,
            ],400);
    }
      public function clinicGetDoctor(Request $request){
      $hospital = Clinic::where('clinicName',$request->name)->first();
      if($hospital){
      $doctor = hospitalAppointment::where('special',$request->speciality)
      ->where('clinic_id',$hospital->id)->count();
      if($doctor){
        $doctor = hospitalAppointment::where('special',$request->speciality)
        ->where('clinic_id',$hospital->id)->get();
        return response()->json([
        'data' => $doctor,
        'message' => 'success'
        ]);
      }
      }
      return response()->json([
          'message' => 'faild'
      ],400);
    }
    public function getAllDoctorClinic(Request $request){
        $clinic = Clinic::where('idCode',$request->idCode)->first();
        if($clinic){
            $doctors = hospitalAppointment::where('clinic_id',$clinic->id)->count();
            if($doctors){
                $doctors = hospitalAppointment::where('clinic_id',$clinic->id)->get();
                return response()->json([
                  'data' => $doctors,
                  'message'=>'sucess',
                ]);
            }
        }
        return response()->json([
         'message' => 'faild',
        ],400);
    }
  }

