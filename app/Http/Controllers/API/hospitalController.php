<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\hospitalRequest;
use App\models\Hosptail;
use App\models\OnlineDoctor;
use App\models\hospitalAppointment;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class hospitalController extends Controller
{
  public function register(Request $request) {
      $hospitalRequest = $request -> all();
      $validator = Validator::make($hospitalRequest, [
          'image' => '',
          'hosptailName' => 'unique:hosptails',
          'Primary_Speciality' => '',
          'Medical_License_Number' => '',
          'Hosptail_License' => '',
          'idCode' => 'unique:hosptails',
          'telephone' => '',
          'Hotline' => '',
          'email' => 'email|unique:hosptails',
          'password' => 'required|confirmed',
          'password_confirmation' => 'sometimes|required_with:password',
          'address' => '',
          'latitude' => '',
          'longitude' => ''
      ]);
      if ($validator -> fails()) {
          return response([
              'error' => $validator -> errors(),
              'Validation Error'
          ]);
      }
      $hospitalRequest['password'] = bcrypt($request -> password);
      $hospitalRequest['password_confirmation'] = bcrypt(
          $request -> password_confirmation
      );
      $hospitalRequest['phoneNumber'] = str_replace(
          'H',
          '+',
          $hospitalRequest['idCode']
      );
      $hospitalRequest['role'] = 'hosptail';
      $hospitalRequest['is_active'] = 1;
      $hospitalRequest['hosptail_labs'] = 0;
      $hospitalRequest['hosptail_xray'] = 0;
      $hospitalRequest['hosptail_pharmacy'] = 0;
      $hospitalCreate = Hosptail::create($hospitalRequest);
      $success['token'] = $hospitalCreate -> createToken('MyApp') -> accessToken;
      if ($hospitalCreate) {
          return response() -> json([
              'data' => $hospitalCreate,
              'message' => 'success',
              'token' => $success['token']
          ]);
      }
  }
  public function uploadImage(Request $request) {
    //return public_path();
    // $image = $request -> file('fileName');

    if( $request->fileName ){
        // $input = $image -> getClientOriginalName();
        // $destinationPath = public_path('uploads/');
        // $image -> move($destinationPath, $input);

        $extension = $request->fileName->extension();
        $file = $request->fileName;
        $code = rand(1111111, 9999999);
        $file_new_name=time().$code ."i".'.'.$extension;
        $file->move('public/uploads/images/', $file_new_name);
        $the_file = 'public/uploads/images/' . $file_new_name ;

        return response() -> json([
            // 'data' => asset('uploads/'.$input),
            'data' => asset( $the_file),
            'message' => 'success Message'
        ], 200);
    }
    else{

        return response() -> json([
            'message' => 'Something wrong, Please try to upload your image again'
        ], 400);
    }

  }
  public function getAll() {
      $hosptails = Hosptail::count();
      if ($hosptails) {
          $hosptail = Hosptail::paginate(20);
          return response([
              'data' => $hosptail,
              'message' => 'success'
          ], 200);
      } else {
          return response(['message' => 'failed']);
      }
  }
  public function login() {
      if (Auth::guard('hosptail') -> attempt([
          'idCode' => request('idCode'),
          'password' => request('password')
      ])) {
          $user = Auth::guard('hosptail') -> user();
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
      $hosptail = Hosptail::where('idCode', $request -> idCode) -> first();
      if ($hosptail) {
          $hosptail -> password = bcrypt($request -> password);
          $hosptail -> update();
          return response() -> json([
              'data' => $hosptail,
              'message' => 'success'
          ]);
      }
      return response() -> json(['message' => 'faild']);
  }
  public function searchHospital(Request $request) {
      $hospital = Hosptail::where('idCode', $request -> idCode) -> count();
      if ($hospital) {
          $hospital = Hosptail::where('idCode', $request -> idCode) -> get();
          return response() -> json([
              'data' => $hospital,
              'message' => 'success',
          ]);
      }
      return response() -> json(['message' => 'failed']);
  }
  public function isHospital(Request $request){
   $re = OnlineDoctor::where('idCode',$request->idCode)->first();
   if($request){
    $hospital = Hosptail::where('idCode',$request->id)->first();
    if($hospital){
    $request1 = OnlineDoctor::where('idCode',$request->idCode)->update([
        'isHospital' => 1,
    ]);
    $search = hospitalAppointment::where('doctor_id', $re->id)
    ->where('hospital_id', $hospital->id)->first();
    if(!$search){
    $doctor = hospitalAppointment::create([
      'doctor_name' => $re->name,
       'idCode' => $request->idCode,
       'address' => $hospital->address,
       'special' => $re->speciality,
       'image'=>$re->image,
       'phoneNumber' => $re->phoneNumber,
       'latitude' =>$hospital->latitude,
       'longitude' =>$hospital->longitude,
       'doctor_id' => $re->id,
       'hospital_id' => $hospital->id,
    ]);
        return response()->json([
       'data' => $doctor,
       'message' => 'success'
        ]);
    }
    return response()->json([
        'message' => 'exist',
        ]);
}

}
    return response()->json([
    'message' => 'faild',
    ]);
  }
  public function getAllDoctor(Request $request){
      $hospital = Hosptail::where('idCode',$request->idCode)->first();
      if($hospital){
          $doctors = hospitalAppointment::where('hospital_id',$hospital->id)->count();
          if($doctors){
            $doctors = hospitalAppointment::where('hospital_id',$hospital->id)->get();
          return response()->json([
           'data' => $doctors,
           'message' => 'success',
          ]);
      }}
        return response()->json([
        'message' => 'faild',
        ]);
  }
public function updateDoctor(Request $request){
    $hospital = Hosptail::where('idCode',$request->id)->first();
    if($hospital){
        $doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
        if($doctor){
            $update= hospitalAppointment::where('hospital_id',$hospital->id)
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
        ]);
}
public function getUpdateDoctor(Request $request){
    $hospital = Hosptail::where('idCode',$request->id)->first();
    if($hospital){
        $doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
        if($doctor){
            $update= hospitalAppointment::where('hospital_id',$hospital->id)
            ->where('doctor_id',$doctor->id)->count();
            if($update){
                $update= hospitalAppointment::where('hospital_id',$hospital->id)
                ->where('doctor_id',$doctor->id)->get();
            return response()->json([
             'data' => $update,
             'message' => 'success'
            ]);
        }}}
        return response()->json([
        'message' => 'faild' ,
        ]);
}
  public function hospitalGetDoctor(Request $request){
  $hospital = Hosptail::where('hosptailName',$request->name)->first();
  if($hospital){
  $doctor = hospitalAppointment::where('special',$request->speciality)
  ->where('hospital_id',$hospital->id)->count();
  if($doctor){
    $doctor = hospitalAppointment::where('special',$request->speciality)
    ->where('hospital_id',$hospital->id)->get();
    return response()->json([
    'data' => $doctor,
    'message' => 'success'
    ]);
  }
  }
  return response()->json([
      'message' => 'faild'
  ]);
}
}
