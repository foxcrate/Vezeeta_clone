<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Lab;
use App\models\Patien;
use App\models\AppointmentLab;
use App\models\QrLab;
use App\models\patientReshouta;
use App\models\rateLab;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class labController extends Controller
{
    public function register(Request $request) {
        $labRequest = $request -> all();
        $validator = Validator::make($labRequest, [
            'image' => '',
            'labsName' => '',
            'Medical_License_Number' => '',
            'labs_License' => '',
            'idCode' => 'required|unique:labs',
            'telephone' => '',
            'Hotline' => '',
            'country' => '',
            'city' => '',
            'area' => '',
            'street' => '',
            'email' => 'email|unique:labs',
            'password' => 'required|confirmed',
            'password_confirmation' => 'sometimes|required_with:password',
            'role' => '',
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
        $labRequest['password'] = bcrypt($request -> password);
        $labRequest['password_confirmation'] = bcrypt($request -> password_confirmation);
        $labRequest['phoneNumber'] = str_replace('L', '+', $labRequest['idCode']);
        $labRequest['role'] = 'labs';
        $labRequest['is_active'] = true;
        $labRequest['is_xray'] = false;
        $labCreate = Lab::create($labRequest);
        $success['token'] = $labCreate -> createToken('MyApp') -> accessToken;
        if ($labCreate) {
            return response() -> json([
                'data' => $labCreate,
                'message' => 'success',
                'token' => $success['token']
            ]);
        }
    }
    public function labGetAll() {
        $labs = Lab::count();
        if ($labs) {
            $labs = Lab::paginate(20);
            return response([
                'data' => $labs,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed']);
        }
    }
    public function login() {
        if (Auth::guard('labs') -> attempt([
            'idCode' => request('idCode'),
            'password' => request('password')
        ])) {
            $user = Auth::guard('labs') -> user();
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
        $patient = Lab::where('idCode', $request -> idCode) -> first();
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
    public function searchLab(Request $request) {
        $hospital = Lab::where('idCode', $request -> idCode) -> count();
        if ($hospital) {
            $hospital = Lab::where('idCode', $request -> idCode) -> get();
            return response() -> json([
                'data' => $hospital,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'failed'],400);
    }
    // swith is array
    public function switchIsXray(Request $request) {
        $lesson = Lab::where('idCode', $request -> idCode) -> update(
            ['is_xray' => $request -> is_xray]
        );
        return response() -> json([
            'data' => $lesson,
            'message' => 'success'
        ]);
    }
    public function switchIsXrayGet(Request $request) {
        $lesson = Lab::where('idCode', $request -> idCode) -> count();
        if ($lesson) {
            $lesson = Lab::where('idCode', $request -> idCode) -> get('is_xray');
            return response() -> json([
                'data' => $lesson,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'failed']);
    }
    public function index(Request $request) {
        $specialties = $this -> getNearby($request);
        if ($specialties) {
            return response([
                'data' => $specialties,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed']);
        }
    }
    private function getNearby($request) {
        $latitudeTo = $request -> latitude;
        $longitudeTo = $request -> longitude;
        $earthRadius = 6378137;
        $nearbyPharmacies = [];
        $pharmacies = Lab::where('labsName', 'LIKE', $request -> name.'%') -> paginate(
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
    public function QrLab(Request $request) {
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
        $qr = QrLab::where('idPatient',$request ->idCode)->first();
        if(!$qr){
        $qr = QrLab::create([
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
    ]);
    }
    public function QrLabGet(Request $request) {
        $qr = QrLab::where([
            'idEnterprise' => $request -> id
        ]) -> count();
        if ($qr) {
            $qr = QrLab::where([
                'idEnterprise' => $request -> id
            ]) -> get();
            return response() -> json([
                'data' => $qr,
                'message' => 'success'
            ]);
        }
        return response() -> json([
            'message' => 'faild'
        ]);
    }
    public function workOut(Request $request){
        $lab = Lab::where('idCode',$request->idCode)->first();
        $app = AppointmentLab::where('lab_id', $lab ->id)
        -> where('longitude',$request ->longitude)
        ->where('latitude', $request->latitude)->first();
        if($lab){
        if ($app == false) {
        $app = AppointmentLab::create([
        'doctor_name'=> $request->doctor_name,
        'address' =>$request->address,
        'idCode' =>$request->idCode,
        'phoneNumber' => $request->phoneNumber,
        'appointments' =>$request->appointments,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'lab_id' => $lab->id,
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
        ]);
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
        ]);
    }
    public function postRate(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
            $lab = Lab::where('idCode',$request->id)->first();
            if($lab){
                $rate = rateLab::create([
                    'rate' => $request->rate,
                    'lab_id' => $lab->id,
                    'patient_id' => $patient->id,
                    'servicing' => $request->servicing,
                    'cleanliness' =>$request->cleanliness,
                    'price' => $request->price,
                    'receiption' =>$request->receiption,
                ]);
                $rates = rateLab::where('lab_id',$lab->id)->avg('rate');
        $doc = Lab::where('idCode',$request->id)->update([
          'totalRating' => $rates,
        ]);
                return response()->json([
                 'data' => $rate,
                 'message' => 'success',
                ]);
                }}
                return response()->json([
                 'message' => 'faild',
                ]);
    }
    public function getRate(Request $request){
        $lab = Lab::where('idCode',$request->idCode)->first();
        if($lab){
            $rate = rateLab::where('lab_id',$lab->id)->count();
            if($rate){
                $rates = rateLab::where('lab_id' ,$lab->id)->get();
                return response()->json([
                'data' => $rates,
                'message' => 'success',
                ]);
            }}
        return response()->json([
         'message' => 'faild',
        ]);
    }
    public function patientRoucheta(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
            $xray = Lab::where('idCode',$request->id)->first();
            if($xray){
                $rocheta = patientReshouta::create([
                  'idpatient' => $patient->id,
                  'idLab' => $xray->id,
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
           ]);
    }
    public function patientRouchetaget(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
                $rocheta = patientReshouta::where('idpatient',$patient->id)->whereNull('idLab')->count();
                if($rocheta){
                $rocheta = patientReshouta::where('idpatient',$patient->id)->whereNull('idLab')->get();
                return response()->json([
                  'data' => $rocheta,
                  'message' => 'success',
                ]);
            }}
        return response()->json([
            'message' => 'faild',
           ]);
    }
    public function patientRouchetagetlab(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
                $rocheta = patientReshouta::where('idpatient',$patient->id)->whereNull('idXray')->count();
                if($rocheta){
                $rocheta = patientReshouta::where('idpatient',$patient->id)->whereNull('idXray')->get();
                return response()->json([
                  'data' => $rocheta,
                  'message' => 'success',
                ]);
            }}
        return response()->json([
            'message' => 'faild',
           ]);
    }
}
