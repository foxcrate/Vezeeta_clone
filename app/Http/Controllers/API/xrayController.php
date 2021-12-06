<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Xray;
use App\models\Patien;
use App\models\AppointmentLab;
use App\models\QrXray;
use Intervention\Image\Facades\Image;
use App\Models\rateLab;
use App\models\patientReshouta;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class xrayController extends Controller
{
    public function register(Request $request) {
        $xrayRequest = $request -> all();
        $validator = Validator::make($xrayRequest, [
            'image' => '',
            'xrayName' => 'required',
            'Medical_License_Number' => 'required',
            'xray_License' => '',
            'phoneNumber' => 'unique:xrays',
            'idCode' => 'required|unique:xrays',
            'telephone' => '',
            'Hotline' => '',
            'email' => 'email|unique:xrays|required',
            'password' => 'confirmed|required',
            'password_confirmation' => 'sometimes|required_with:password',
            'address' => 'required',
            'latitude' => '',
            'longitude' => ''
        ]);
        if ($validator -> fails()) {
            return response([
                'error' => $validator -> errors(),
                'Validation Error'
            ]);
        }
        $xrayRequest['password'] = bcrypt($request -> password);
        $xrayRequest['password_confirmation'] = bcrypt(
            $request -> password_confirmation
        );
        $xrayRequest['phoneNumber'] = str_replace('X', '+', $xrayRequest['idCode']);
        $xrayRequest['role'] = 'xray';
        $xrayRequest['is_active'] = true;
        $xrayRequest['is_labs'] = false;
        $xrayCreate = Xray::create($xrayRequest);
        $success['token'] = $xrayCreate -> createToken('MyApp') -> accessToken;
        if ($xrayCreate) {
            return response() -> json([
                'data' => $xrayCreate,
                'message' => 'success',
                'token' => $success['token']
            ]);
        }
    }
    public function xrayGetAll() {
        $hosptails = Xray::count();
        if ($hosptails) {
            $hosptail = Xray::paginate(20);
            return response([
                'data' => $hosptail,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed'],400);
        }
    }
    public function login() {
        if (Auth::guard('xray') -> attempt([
            'idCode' => request('idCode'),
            'password' => request('password')
        ])) {
            $user = Auth::guard('xray') -> user();
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
        $xray = Xray::where('idCode', $request -> idCode) -> first();
        if ($xray) {
            $xray -> password = bcrypt($request -> password);
            $xray -> update();
            return response() -> json([
                'data' => $xray,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function searchXray(Request $request) {
        $hospital = Xray::where('idCode', $request -> idCode) -> count();
        if ($hospital) {
            $hospital = Xray::where('idCode', $request -> idCode) -> get();
            return response() -> json([
                'data' => $hospital,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'failed'],400);
    }
    public function switchIsLab(Request $request) {
        $lesson = Xray::where('idCode', $request -> idCode) -> update(
            ['is_labs' => $request -> is_labs]
        );
        return response() -> json([
            'data' => $lesson,
            'message' => 'success'
        ]);
    }
    public function switchIsLabGet(Request $request) {
        $lesson = Xray::where('idCode', $request -> idCode) -> count();
        if ($lesson) {
            $lesson = Xray::where('idCode', $request -> idCode) -> get('is_labs');
            return response() -> json([
                'data' => $lesson,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'failed'],400);
    }
    public function index(Request $request) {
        $specialties = $this -> getNearby($request);
        if ($specialties) {
            return response([
                'data' => $specialties,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed'],400);
        }
    }
    private function getNearby($request) {
        $latitudeTo = $request -> latitude;
        $longitudeTo = $request -> longitude;
        $earthRadius = 6378137;
        $nearbyPharmacies = [];
        $pharmacies = Xray::where('xrayName', 'LIKE', $request -> name.'%') -> paginate(
            20
        );
        foreach($pharmacies as $pharmacy) {
            $latitudeFrom = $pharmacy -> latitude;
            $longitudeFrom = $pharmacy -> longitude;
            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);
            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;
            $angle = 2 * asin(
                sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2))
            );
            $distance = round($angle * $earthRadius);
            //$distance = $distance >= 1000 ? (round($distance/1000, 2)) : $distance;
            $pharmacy -> distance = $distance;
            if ($distance > 500) {
                continue;
            }
            array_push($nearbyPharmacies, $pharmacy);
        }
        if (count($nearbyPharmacies)) {
            return $nearbyPharmacies;
        }
    }
    public function QrXray(Request $request) {
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
        $qr = QrXray::where('idPatient',$request ->idCode)->first();
        if(!$qr){
            $qr = QrXray::create([
                'idPatient'     => $request ->idCode,
                'idEnterprise'   => $request->id
            ]);
            return response() -> json([
                'data' => $qr,
                'message' => 'success'
            ]);
    }
    else{
        return response()->json([
          'message' => 'Patient Exist'
        ]);
    }
    }
    return response()->json([
     'message' => 'faild',
    ],400);
    }

	 public function QrXrayGet(Request $request) {
        $qr = QrXray::where([
            'idEnterprise' => $request -> id
        ]) -> count();
        if ($qr) {
            $qr = QrXray::where([
                'idEnterprise' => $request -> id
            ]) -> get();
            return response() -> json([
                'data' => $qr,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'failed'],400);
    }
    public function workOut(Request $request){
        $xray =Xray::where('idCode',$request->idCode)->first();
        $app = AppointmentLab::where('xray_id', $xray ->id)
        -> where('longitude',$request ->longitude)
        ->where('latitude', $request->latitude)->first();
        if($xray){
        if ($app == false) {
        $app = AppointmentLab::create([
        'doctor_name'=> $request->doctor_name,
        'idCode' =>$request->idCode,
        'address' =>$request->address,
        'phoneNumber' => $request->phoneNumber,
        'appointments' =>$request->appointments,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'xray_id' => $xray->id,
        ]);
        return response()->json([
        'data' => $app,
        'message' => 'success',
        ]);
        }else {
        $app->update(['appointments' => $request->appointments]);
        return response([
        'data' => $app,
        'message' => 'success'
        ]);
        }
       }
       return response()->json([
        'message' => 'faild',
        ],400);
    }
    public function getwork(Request $request){
    $lab = AppointmentLab::where('idCode',$request->idCode)->count();
    if($lab){
    $labs = AppointmentLab::where('idCode',$request->idCode)->get();
    return response()->json([
    'data' => $labs,
    'message' =>'success',
    ]);
    }
    return response()->json([
    'message' => 'faild',
    ],400);
    }
    public function deleteAppoinment(Request $request){

        $appointment = AppointmentLab::where('address',$request->address)->first();
        if($appointment){
         $appointment = AppointmentLab::where('address',$request->address)->delete();
         return response()->json([
        'data' => $appointment,
        'message' => 'success'
         ]);
         }
         return response()->json([
         'message' =>'faild'
         ],400);
        }
        public function postRate(Request $request){
            $patient = Patien::where('idCode',$request->idCode)->first();
            if($patient){
                $lab = Xray::where('idCode',$request->id)->first();
                if($lab){
                    $rate = rateLab::create([
                        'rate' => $request->rate,
                        'xray_id' => $lab->id,
                        'patient_id' => $patient->id,
                        'servicing' => $request->servicing,
                        'cleanliness' =>$request->cleanliness,
                        'price' => $request->price,
                        'receiption' =>$request->receiption,
                    ]);
                    $rates = rateLab::where('xray_id',$lab->id)->avg('rate');
            $doc = Xray::where('idCode',$request->id)->update([
              'totalRating' => $rates,
            ]);
                    return response()->json([
                     'data' => $rate,
                     'message' => 'success',
                    ]);
                    }}
                    return response()->json([
                     'message' => 'faild',
                    ],400);
        }
        public function getRate(Request $request){
            $lab = Xray::where('idCode',$request->idCode)->first();
            if($lab){
                $rate = rateLab::where('xray_id',$lab->id)->count();
                if($rate){
                    $rates = rateLab::where('xray_id' ,$lab->id)->get();
                    return response()->json([
                    'data' => $rates,
                    'message' => 'success',
                    ]);
                }}
            return response()->json([
             'message' => 'faild',
            ],400);
        }
        public function patientRoucheta(Request $request){
            $patient = Patien::where('idCode',$request->idCode)->first();
            if($patient){
                $xray = Xray::where('idCode',$request->id)->first();
                if($xray){
                    $rocheta = patientReshouta::create([
                      'idpatient' => $patient->id,
                      'idXray' => $xray->id,
                      'link' => $request -> link,
                      'information' => $request->information,
                    ]);
                    return response()->json([
                      'data' => $rocheta,
                      'message' => 'success',
                    ]);
                }
            }
            return response()->json([
                'message' => 'faild',
               ],400);
        }

}
