<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\API\users\Store;
use App\models\Clinic;
use App\models\Hosptail;
use App\models\Lab;
use App\models\Nurse;
use App\models\OnlineDoctor;
use App\models\Patien;
use App\models\Xray;
use Validator;
use JWTAuth;
use Response;
class userController extends Controller
{
    // public login function
    public function login(Request $request){
        if($request->type == 'patient'){
            if (auth()->guard('patien') -> attempt([
                'idCode' => request('idCode'),
                'password' => request('password')
            ])) {
                $user = auth()->guard('patien') -> user();
                $success['token'] = $user -> createToken('MyApp') -> accessToken;
                return response() -> json([
                    'data' => $user,
                    'message' => 'success',
                    'token' => $success['token']
                ]);
            } else {
                return response() -> json(['error' => 'Unauthorised'], 401);
            }

        }elseif($request->type == 'clinic'){
            if (auth()->guard('patien') -> attempt([
                'idCode' => request('idCode'),
                'password' => request('password')
            ])) {
                $user = auth()->guard('clinic') -> user();
                $success['token'] = $user -> createToken('MyApp') -> accessToken;
                return response() -> json([
                    'data' => $user,
                    'message' => 'success',
                    'token' => $success['token']
                ]);
            } else {
                return response() -> json(['error' => 'Unauthorised'], 401);
            }
        }elseif($request->type == 'hosptail'){
            if (auth()->guard('patien') -> attempt([
                'idCode' => request('idCode'),
                'password' => request('password')
            ])) {
                $user = auth()->guard('hosptail') -> user();
                $success['token'] = $user -> createToken('MyApp') -> accessToken;
                return response() -> json([
                    'data' => $user,
                    'message' => 'success',
                    'token' => $success['token']
                ]);
            } else {
                return response() -> json(['error' => 'Unauthorised'], 401);
            }
        }elseif($request->type == 'xray'){
            if (auth()->guard('xray') -> attempt([
                'idCode' => request('idCode'),
                'password' => request('password')
            ])) {
                $user = auth()->guard('xray') -> user();
                $success['token'] = $user -> createToken('MyApp') -> accessToken;
                return response() -> json([
                    'data' => $user,
                    'message' => 'success',
                    'token' => $success['token']
                ]);
            } else {
                return response() -> json(['error' => 'Unauthorised'], 401);
            }

        }elseif($request->type == 'labs'){
            if (auth()->guard('labs') -> attempt([
                'idCode' => request('idCode'),
                'password' => request('password')
            ])) {
                $user = auth()->guard('labs') -> user();
                $success['token'] = $user -> createToken('MyApp') -> accessToken;
                return response() -> json([
                    'data' => $user,
                    'message' => 'success',
                    'token' => $success['token']
                ]);
            } else {
                return response() -> json(['error' => 'Unauthorised'], 401);
            }
        }elseif($request->type == 'pharmacy'){
            if (auth()->guard('pharmacy') -> attempt([
                'idCode' => request('idCode'),
                'password' => request('password')
            ])) {
                $user = auth()->guard('pharmacy') -> user();
                $success['token'] = $user -> createToken('MyApp') -> accessToken;
                return response() -> json([
                    'data' => $user,
                    'message' => 'success',
                    'token' => $success['token']
                ]);
            } else {
                return response() -> json(['error' => 'Unauthorised'], 401);
            }
        }elseif($request->type == 'online_doctor'){
            if (auth()->guard('online_doctor') -> attempt([
                'idCode' => request('idCode'),
                'password' => request('password')
            ])) {
                $user = auth()->guard('online_doctor') -> user();
                $success['token'] = $user -> createToken('MyApp') -> accessToken;
                return response() -> json([
                    'data' => $user,
                    'message' => 'success',
                    'token' => $success['token']
                ]);
            } else {
                return response() -> json(['error' => 'Unauthorised'], 401);
            }
        }elseif($request->type == 'nurse'){
            if (auth()->guard('nurse') -> attempt([
                'idCode' => request('idCode'),
                'password' => request('password')
            ])) {
                $user = auth()->guard('nurse') -> user();
                $success['token'] = $user -> createToken('MyApp') -> accessToken;
                return response() -> json([
                    'data' => $user,
                    'message' => 'success',
                    'token' => $success['token']
                ]);
            } else {
                return response() -> json(['error' => 'Unauthorised'], 401);
            }
        }else{
            return response()->json([
                'message' => 'faild message',
                'status' => false
            ],400);
        }

    }

    // get user basic data
    public function getBasicDate(Request $request){
        // code
        if($request->type == 'patient'){
            $patient = Patien::where('idCode',$request->idCode)->first();
            if($patient){
                return response()->json([
                    'data' => $patient,
                    'message' => 'success',
                    'status' => true,
                ],200);
            }else{
                return response()->json([
                    'message' => 'patient not found',
                    'status' => false,
                ],404);
            }
        }elseif($request->type == 'clinic'){
            $clinic = Clinic::where('idCode',$request->idCode)->first();
            if($clinic){
                return response()->json([
                    'data' => $clinic,
                    'message' => 'success',
                    'status' => true,
                ],200);
            }else{
                return response()->json([
                    'message' => 'clinic not found',
                    'status' => false,
                ],404);
            }
        }elseif($request->type == 'hosptail'){
            $hosptail = Hosptail::where('idCode',$request->idCode)->first();
            if($hosptail){
                return response()->json([
                    'data' => $hosptail,
                    'message' => 'success',
                    'status' => true,
                ],200);
            }else{
                return response()->json([
                    'message' => 'hosptail not found',
                    'status' => false,
                ],404);
            }
        }elseif($request->type == 'xray'){
            $xray = Xray::where('idCode',$request->idCode)->first();
            if($xray){
                return response()->json([
                    'data' => $xray,
                    'message' => 'success',
                    'status' => true,
                ],200);
            }else{
                return response()->json([
                    'message' => 'xray not found',
                    'status' => false,
                ],404);
            }
        }elseif($request->type == 'labs'){
            $lab = Lab::where('idCode',$request->idCode)->first();
            if($lab){
                return response()->json([
                    'data' => $lab,
                    'message' => 'success',
                    'status' => true,
                ],200);
            }else{
                return response()->json([
                    'message' => 'lab not found',
                    'status' => false,
                ],404);
            }
        }elseif($request->type == 'pharmacy'){
            $pharmacy = Patien::where('idCode',$request->idCode)->first();
            if($pharmacy){
                return response()->json([
                    'data' => $pharmacy,
                    'message' => 'success',
                    'status' => true,
                ],200);
            }else{
                return response()->json([
                    'message' => 'pharmacy not found',
                    'status' => false,
                ],404);
            }
        }elseif($request->type == 'online_doctor'){
            $online_doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
            if($online_doctor){
                return response()->json([
                    'data' => $online_doctor,
                    'message' => 'success',
                    'status' => true,
                ],200);
            }else{
                return response()->json([
                    'message' => 'doctor not found',
                    'status' => false,
                ],404);
            }
        }elseif($request->type == 'nurse'){
            $nurse = Nurse::where('idCode',$request->idCode)->first();
            if($nurse){
                return response()->json([
                    'data' => $nurse,
                    'message' => 'success',
                    'status' => true,
                ],200);
            }else{
                return response()->json([
                    'message' => 'nurse not found',
                    'status' => false,
                ],404);
            }
        }
    }

    // public forgot password function
    public function forgotpassword(Request $request){
        return $request;
    }
}
