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
                return response() -> json(['message' => 'Your idCode or your password are inCorrect, please try again'], 401);
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
        }elseif($request->type == 'doctor'){
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
        //return "Alo";
        if($request->type == 'patient'){
            $patient = Patien::where('idCode',$request->idCode)->first();
            //return $patient;
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
        }elseif($request->type == 'doctor'){
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

    // check phone Number
    public function checkPhoneNumber(Request $request){
        try{
            if($request->phoneNumber[0] == '0'){
                $publicRequest['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $publicRequest['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            if($request->type == 'patient'){
                $patient = Patien::where('phoneNumber',$publicRequest['phoneNumber'])->first();
                if($patient){
                    return response()->json([
                        'message' => 'Your Number is exist in our record, please try again with another number.                        ',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register                    ',
                    'status' => false
                ],400);
            }elseif($request->type == 'doctor'){
                $doctor = OnlineDoctor::where('phoneNumber',$publicRequest['phoneNumber'])->first();
                if($doctor){
                    return response()->json([
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'xray'){
                $xray = Xray::where('phoneNumber',$publicRequest['phoneNumber'])->first();
                if($xray){
                    return response()->json([
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'lab'){
                $lab = Lab::where('phoneNumber',$publicRequest['phoneNumber'])->first();
                if($lab){
                    return response()->json([
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'pharmacy'){
                $pharmacy = Pharmacy::where('phoneNumber',$publicRequest['phoneNumber'])->first();
                if($pharmacy){
                    return response()->json([
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'nurse'){
                $nurse = Nurse::where('phoneNumber',$publicRequest['phoneNumber'])->first();
                if($nurse){
                    return response()->json([
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],500);
        }
    }

    // public forgot password function
   public function userForgotPassword(Request $request){
        try{
            // if($request->phoneNumber[0] == '0'){
            //     $publicRequest['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            // }else{
            //     $publicRequest['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            // }
            if($request->type == 'patient'){
                $patient = Patien::where('idCode',$request->idCode)->first();
                if($patient){
                    return response()->json([
                        'data' => $patient->phoneNumber,
                        'message' => 'Your Number is exist in our record, please try again with another number.                        ',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register                    ',
                    'status' => false
                ],400);
            }elseif($request->type == 'doctor'){
                $doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
                if($doctor){
                    return response()->json([
                        'data' => $doctor->phoneNumber,
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'xray'){
                $xray = Xray::where('idCode',$request->idCode)->first();
                if($xray){
                    return response()->json([
                        'data' => $xray->phoneNumber,
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'lab'){
                $lab = Lab::where('idCode',$request->idCode)->first();
                if($lab){
                    return response()->json([
                        'data' => $lab->phoneNumber,
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'pharmacy'){
                $pharmacy = Pharmacy::where('idCode',$request->idCode)->first();
                if($pharmacy){
                    return response()->json([
                        'data' => $pharmacy->phoneNumber,
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'nurse'){
                $nurse = Nurse::where('idCode',$request->idCode)->first();
                if($nurse){
                    return response()->json([
                        'data' => $nurse->phoneNumber,
                        'message' => 'Your Number is exist in our record, please try again with another number.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],500);
        }
    }

    public function userConfirmPassword(Request $request){
        try{
            // if($request->phoneNumber[0] == '0'){
            //     $publicRequest['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            // }else{
            //     $publicRequest['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            // }
            if($request->type == 'patient'){
                $patient = Patien::where('idCode',$request->idCode)->first();
                if($patient){
                    $patient->password = bcrypt($request->password);
                    $patient->save();
                    return response()->json([
                        'message' => 'password updated',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register                    ',
                    'status' => false
                ],400);
            }elseif($request->type == 'doctor'){
                $doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
                if($doctor){
                    $doctor->password = bcrypt($request->password);
                    $doctor->save();
                    return response()->json([
                        'message' => 'password updated',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'xray'){
                $xray = Xray::where('idCode',$request->idCode)->first();
                if($xray){
                    $xray->password = bcrypt($request->password);
                    $xray->save();
                    return response()->json([
                        'message' => 'password updated',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'lab'){
                $lab = Lab::where('idCode',$request->idCode)->first();
                if($lab){
                    $lab->password = bcrypt($request->password);
                    $lab->save();
                    return response()->json([
                        'message' => 'password updated',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'pharmacy'){
                $pharmacy = Pharmacy::where('idCode',$request->idCode)->first();
                if($pharmacy){
                    $pharmacy->password = bcrypt($request->password);
                    $pharmacy->save();
                    return response()->json([
                        'message' => 'password updated',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }elseif($request->type == 'nurse'){
                $nurse = Nurse::where('idCode',$request->idCode)->first();
                if($nurse){
                    $nurse->password = bcrypt($request->password);
                    return response()->json([
                        'message' => 'password updated.',
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => 'Your Number is not Exist in Our records, please go and register',
                    'status' => false
                ],400);
            }
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],500);
        }
    }
}
