<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\models\Nurse;
class nurseController extends Controller
{
    public function register(Request $request) {
        $doctorRequest = $request -> all();
        $validator = Validator::make($doctorRequest, [
            'image' => 'max:3072',
            'name' => 'required',
            'countryCode' => '',
            'idCode' => 'unique:nurses',
            'password' => 'required',
            'gender' => 'required',
            'information' => '',
            'national_id_front_side' => 'max:2048',
            'national_id_back_side' => 'max:2048',
            'national_id' => 'max:2048',
            'Nationality' => 'max:2048',
            'branch' => '',
            'address' => '',
            'Nationality' => '',
            'latitude' => '',
            'longitude' => ''
        ]);
        if ($validator -> fails()) {
            return response([
                'error' => $validator -> errors(),
                'Validation Error'
            ]);
        }
        $doctorRequest['password'] = bcrypt($request -> password);
        $doctorRequest['phoneNumber'] = str_replace('N', '+', $doctorRequest['idCode']);
        $doctorRequest['is_active'] = true;
        $doctorRequest['online'] = false;
        $doctorRequest['is_faviorate'] = true;
        $doctorCreate = Nurse::create($doctorRequest);
        $success['token'] = $doctorCreate -> createToken('MyApp') -> accessToken;
        if ($doctorCreate) {
            return response() -> json([
                'data' => $doctorCreate,
                'message' => 'success',
                'token' => $success['token']
            ]);
        }
    }
    public function login() {
        if (Auth::guard('nurse') -> attempt([
            'idCode' => request('idCode'),
            'password' => request('password')
        ])) {
            $user = Auth::guard('nurse') -> user();
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
    public function searchNurse(Request $request) {
        $hospital = Nurse::where('idCode', $request -> idCode) -> count();
        if ($hospital) {
            $hospital = Nurse::where('idCode', $request -> idCode) -> get();
            return response() -> json([
                'data' => $hospital,
                'massage' => 'success'
            ]);
        }
        return response() -> json(['massage' => 'failed'],400);
    }
    public function switchOn(Request $request) {
        $reqdata = $request -> all();
        $reqdata['online'] = 1;
        $lesson = Nurse::where('idCode', $request -> idCode)->first();
        if($lesson){
        $lesson = Nurse::where('idCode', $request -> idCode) -> update($reqdata);
        return response() -> json(['success' => $lesson]);
        }
        return response()->json([
            'message' => 'faild',
        ],400);
    }
    public function switchOf(Request $request) {
        $reqdata = $request -> all();
        $reqdata['online'] = 0;
        $lesson = Nurse::where('idCode', $request -> idCode)->first();
        if($lesson){
        $lesson = Nurse::where('idCode', $request -> idCode) -> update($reqdata);
        return response() -> json(['success' => $lesson]);
    }
    return response()->json([
    'message' => 'faild'
    ],400);
    }
    public function confirm_password(Request $request) {
        $patient = Nurse::where('idCode', $request -> idCode) -> first();
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
    public function index(Request $request) {
        $nurses = $this -> getNearby($request);
        if ($nurses) {
            return response([
                'data' => $nurses,
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
        $nearbyNurses = [];
        $nurses = Nurse::where('name', 'LIKE', $request -> name.'%') -> paginate(20);
        foreach($nurses as $nurse) {
            $latitudeFrom = $nurse -> latitude;
            $longitudeFrom = $nurse -> longitude;
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
            $nurse -> distance = $distance;
            if ($distance > 500) {
                continue;
            }
            array_push($nearbyNurses, $nurse);
        }
        if (count($nearbyNurses)) {
            return $nearbyNurses;
        }
    }
}
