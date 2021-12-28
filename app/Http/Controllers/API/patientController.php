<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\patientRequest;
use App\models\Patien;
use App\models\patientData;
use App\models\Raoucheh;
use App\models\Checkup;
use App\models\clupTransaction;
use App\models\medicalDevices;
use App\models\patientCar;
use App\models\DeviceRequest;
use App\models\Donor;
use App\models\needDonor;
use App\models\requestDonor;
use App\models\medicationRequest;
use App\models\covidPcr;
use App\models\covidVac;
use App\models\covidCountry;
use App\models\Medication;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
class patientController extends Controller
{
    public function patientReport(Request $request){
        try{
            $patientReport = Patien::where('idCode',$request->idCode)
                            ->with(['patinets_data','childern'])
                            ->first();
            $lastCheckup = Checkup::where('patient_id',$patientReport->id)->latest()->first();
            if($patientReport){
                return response()->json([
                   'data' => $patientReport,
                   'lastCheckup' => $lastCheckup,
                   'message' => 'success',
                   'status' => true
                ]);
            }
            return response()->json([
                'message' => 'patient not found',
                'status' => false
            ],400);
        }catch (\Exception $ex){
            return response()->json([
               'message' => $ex->getMessage(),
               'status' => false
            ],500);
        }
    }
    public function register(Request $request) {
        $hospitalRequest = $request -> all();
        $validator = Validator::make($hospitalRequest, [
            'image' => 'max:3071',
            'firstName' => 'required',
            'middleName' => '',
            'lastName' => '',
            'BirthDate' => 'required',
            'gender' => 'required',
            'email' => 'email|unique:patiens',
            'password' => 'required|confirmed',
            'password_confirmation' => 'sometimes|required_with:password',
            'state' => 'required',
            'job' => '',
            'race' => '',
            'address' => 'required',
            'latitude' => '',
            'longitude' => ''
        ]);
        if ($validator -> fails()) {
            foreach($validator->errors()->toArray() as $e){
                return response()->json([
                    'message' => $e,
                    'status' => false,
                ],400);
            }
        }
        $hospitalRequest['password'] = bcrypt($request -> password);
        $hospitalRequest['password_confirmation'] = bcrypt(
            $request -> password_confirmation
        );
        $hospitalRequest['name'] = $request -> firstName.' '.$request -> lastName;
        if($request->phoneNumber[0] == '0'){
            $hospitalRequest['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
        }else{
            $hospitalRequest['phoneNumber'] = $request->countryCode . $request->phoneNumber;
        }
        $hospitalRequest['idCode'] = str_replace(
            '+',
            'P',
            $hospitalRequest['phoneNumber']
        );
        $hospitalRequest['role'] = 'patient';
        $hospitalRequest['is_active'] = false;
        $hospitalRequest['online'] = false;
        $hospitalCreate = Patien::create($hospitalRequest);
        $patientData = patientData::where('patient_id', $hospitalCreate -> id) -> create(
            [
                'width' => $request -> width,
                'height' => $request -> height,
                'width_type' => $request -> width_type,
                'blood' => $request -> blood,
                'patient_id' => $hospitalCreate -> id
            ]
        );
        $success['token'] = $hospitalCreate -> createToken('MyApp') -> accessToken;
        if ($hospitalCreate) {
            return response() -> json([
                'data' => $hospitalCreate,
                'message' => 'success',
                'token' => $success['token']
            ]);
        }
    }
    //return all patients
    public function getAll() {
        $hosptails = Patien::count();
        if ($hosptails) {
            $hosptail = Patien::get();
            return response([
                'data' => $hosptail,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed']);
        }
    }
    //search patient by idCode
    public function searchId(Request $request) {
        $doctor = Patien::where('idCode', $request -> idCode) -> count();
        if ($doctor == true) {
            $doctor = Patien::where('idCode', $request -> idCode) -> get();
            return response() -> json([
                'data' => $doctor,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild']);
    }
    public function login(){
        if (Auth::guard('patien') -> attempt([
            'idCode' => request('idCode'),
            'password' => request('password')
        ])) {
            $user = Auth::guard('patien') -> user();
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
    //switch online
    public function switchOn(Request $request, $idCode) {
        $reqdata = $request -> all();
        $reqdata['online'] = 1;
        $lesson = Patien::where('idCode', $request -> idCode)->first();
        if($lesson){
            $lesson = Patien::where('idCode', $request -> idCode) -> update($reqdata);
            return response() -> json(['success' => $lesson]);
        }
        return response()->json([
        'message' => 'false',
        ]);
    }
    //switch offline
    public function switchOf(Request $request, $idCode) {
        $reqdata = $request -> all();
        $reqdata['online'] = 0;
        $lesson = Patien::where('idCode', $request -> idCode)->first();
        if($lesson){
        $lesson = Patien::where('idCode', $request -> idCode) -> update($reqdata);
        return response() -> json(['success' => $lesson]);
        }
        return response()->json([
     'message' => 'faild',
        ]);
    }
    //basicData
    public function basicData(Request $request){
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $patientData = patientData::where('patient_id', $patient -> id) -> first();
            if ($patientData) {
                $patientData -> update($request -> except($request -> idCode));
                return response() -> json([
                    'data' => $patientData,
                    'message' => 'success'
                ]);
            } else {
                $patientData = patientData::create([
                    'width' => $request->width,
                    'height' => $request->height,
                    'width_type' => $request->width_type,
                    'blood' => $request->blood,
                    'patient_id' => $patient->id
                ]);
                return response() -> json([
                    'data' => $patientData,
                    'message' => 'success'
                ]);
            }
        }
        return response() -> json(['message' => 'faild'],400);
    }
    //if is need to be donor but blood is null so can updated enter
    public function updateBlood(Request $request){
        $patient = Patien::where('idCode', $request->idCode)->first();
        if ($patient) {
            $req = $request->is_donor;
            $req['is_donor'] = 1;
          $donor = Patien::where('idCode',$request->idCode)->update($req);
            $patientData = patientData::where('patient_id', $patient ->id)->first();
            if ($patientData) {
             $patientData -> update($request -> except($request -> idCode));
                 return response()->json([
                    'data' => $patientData,
                    'message' => 'success'
                ]);
            }}
            return response()->json([
             'message' => 'faild'
            ]);
    }
    //get specific coloumn
    public function getPatientData(Request $request) {
        $patients = Patien::where('idCode', $request -> idCode) -> first();
        if ($patients) {
            $patient = patientData::where('patient_id', $patients -> id) -> select(
                ['width', 'height', 'width_type', 'blood']
            ) -> first();
            return response([
                'data' => $patient,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed'],400);
        }
    }

    public function UpdateOnline(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if ($patient) {
            $patient -> online = $request -> online;
            $patient -> save();
            return response() -> json([
                'data' => $patient -> online,
                'status' => true,
                'message' => 'updated success'
            ]);
        }
        return response() -> json([
            'status' => false,
            'message' => 'patient not found'
        ],404);
    }
    public function medication(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
            if ($patient) {
                $profileCreate = patientData::where('patient_id', $patient -> id) -> update(
                    ['medication_name' => json_encode($request -> medication_name)]
                );
                return response() -> json([
                    'data' => $profileCreate,
                    'message' => 'success'
                ]);
            }
            return response()->json(['message' => 'faild'],400);
    }
    public function medicationGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient->id)->select(
                ['medication_name']
            ) -> first();
            // $medicationGet['medication_name'] = json_decode(
            //     $medicationGet -> medication_name
            // );
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function medicationdelete(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient->id)
            ->where('medication_name[id]',$request->id )->delete();
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild']);
    }
    public function allergiData(Request $request) {
        $dataRequest = $request->all();
        $validator = Validator::make($dataRequest, [
            'idCode' => 'required',
        ]);
        if ($validator -> fails()) {
            foreach($validator->errors()->toArray() as $e){
                return response()->json([
                    'message' => $e,
                    'status' => false,
                ],400);
            }
        }
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $profileCreate = patientData::where('patient_id', $patient -> id) -> update(
                ['allergi_data' => json_encode($request -> allergi_data)]
            );
            return response() -> json([
                'data' => $profileCreate,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild',400]);
    }
    public function allergiDataGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id)->select(
                ['allergi_data']
            ) -> first();
           // $medicationGet['allergi_data'] = json_decode($medicationGet -> allergi_data);
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function agreeNameData(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $profileCreate = patientData::where('patient_id', $patient -> id) -> update(
                ['agree_name' => json_encode($request -> agree_name)]
            );
            return response() -> json([
                'data' => $profileCreate,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function agreeNameGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> select(
                ['agree_name']
            ) -> first();
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function surgeryData(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $profileCreate = patientData::where('patient_id', $patient -> id) -> update(
                ['surgery_data' => json_encode($request -> surgery_data)]
            );
            return response() -> json([
                'data' => $profileCreate,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function surgeryGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> select(
                ['surgery_data']
            ) -> first();
          //  $medicationGet['surgery_data'] = json_decode($medicationGet -> surgery_data);
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    // mother data
    public function motherData(Request $request, $idCode) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $profileCreate = patientData::where('patient_id', $patient -> id) -> update(
                ['mother' => json_encode($request -> mother)]
            );
            return response() -> json([
                'data' => $profileCreate,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    // mother get data
    public function motherGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> select(
                ['mother']
            ) -> first();
          //  $medicationGet['mother'] = json_decode($medicationGet -> mother);
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    // father data
    public function fatherData(Request $request, $idCode) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
            $profileCreate = patientData::where('patient_id', $patient->id) -> update(
                ['father' => json_encode($request->father)]
            );
            return response() -> json([
                'data' => $profileCreate,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    // father get data
    public function fatherGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if($patient){
        $medicationGet = patientData::where('patient_id', $patient -> id) -> first();
        if ($medicationGet) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> select(
                ['father']
            ) -> first();
            //$medicationGet['father'] = json_decode($medicationGet -> father);
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }}
        return response() -> json(['message' => 'faild'],400);
    }
    // wife data
    public function WifeData(Request $request, $idCode) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $profileCreate = patientData::where('patient_id', $patient -> id) -> update([
                'wife_Period_Cycle' => $request -> wife_Period_Cycle,
                'wife_Abotion' => $request -> wife_Abotion,
                'wife_Contraceptive' => $request -> wife_Contraceptive
            ]);
            return response() -> json([
                'data' => $profileCreate,
                'message' => 'success',
                'status' => true,
            ]);
        }
        return response() -> json(['message' => 'faild']);
    }
    // wife get data
    public function WifeGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> select(
                ['wife_Period_Cycle', 'wife_Abotion', 'wife_Contraceptive']
            ) -> first();
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function femaleMotherData(Request $request, $idCode) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $profileCreate = patientData::where('patient_id', $patient -> id) -> update([
                'mother_Period_Cycle' => $request -> mother_Period_Cycle,
                'mother_pregnency' => $request -> mother_pregnency,
                'mother_abotion' => $request -> mother_abotion,
                'mother_deliveries' => $request -> mother_deliveries,
                'mother_complicetion' => $request -> mother_complicetion,
                'mother_Contraceptive' => $request -> mother_Contraceptive,
            ]);
            return response() -> json([
                'data' => $profileCreate,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild']);
    }
    public function femaleMotherGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> select([
                'mother_Period_Cycle',
                'mother_pregnency',
                'mother_abotion',
                'mother_deliveries',
                'mother_complicetion',
                'mother_Contraceptive'
            ]) -> first();
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild']);
    }
    public function smoking(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $patientData = patientData::where('patient_id', $patient -> id) -> first();
            if ($patientData) {
                $profileCreate = patientData::where('patient_id', $patient -> id) -> update(
                    ['smoking' => json_encode($request -> smoking)]
                );
                return response() -> json([
                    'data' => $profileCreate,
                    'message' => 'success'
                ]);
            } else {
                $profileCreate = patientData::create([
                    'alcohol' => $request -> alcohol,
                    'cigarette' => $request -> cigarette,
                    'drug' => $request -> width_type,
                    'patient_id' => $patient -> id
                ]);
                return response() -> json([
                    'data' => $profileCreate,
                    'message' => 'success'
                ]);
            }
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function smokingGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $smokingGet = patientData::where('patient_id', $patient -> id) -> select(
                ['smoking']
            ) -> first();
            //$smokingGet['smoking'] = json_decode($smokingGet -> smoking);
            return response() -> json([
                'data' => $smokingGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function periodSwitch(Request $request, $idCode) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {

            $profileCreate = patientData::where('patient_id', $patient -> id) -> update(
                ['single_Period_Cycle' => $request -> single_Period_Cycle]
            );
            return response() -> json([
                'data' => $profileCreate,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function periodSwitchGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> select(
                ['single_Period_Cycle']
            ) -> first();
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild',400]);
    }
    public function checkup(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $profileCreate = Checkup::create([
                'temperature' => $request -> temperature,
                'blood_pressure' => $request -> blood_pressure,
                'diabetics' => $request -> diabetics,
                'oxygen' => $request->oxygen,
                'date' => $request -> date,
                'patient_id' => $patient -> id
            ]);
            return response() -> json([
                'data' => $profileCreate,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild',400]);
    }
    public function deleteCheckup(Request $request){
        $checkup = Checkup::where('id', $request -> id) -> first();
        if ($checkup) {
            $checkup = Checkup::where('id', $checkup -> id)->delete();
            return response() -> json([
                'data' => $checkup,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild',400]);
    }
    public function checkupGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = Checkup::where('patient_id', $patient -> id) -> count();
            if ($medicationGet){
                $medicationGet = Checkup::where('patient_id', $patient -> id) -> get();
                return response() -> json([
                    'data' => $medicationGet,
                    'message' => 'success'
                ]);
            }}
        return response() -> json(['message' => 'faild',400]);
    }
    public function checkupGetLast(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = Checkup::where('patient_id', $patient -> id) -> count();
            if ($medicationGet){
                $medicationGet = Checkup::where('patient_id', $patient -> id) -> get()->last();
                return response() -> json([
                    'data' => $medicationGet,
                    'message' => 'success'
                ]);
            }}
        return response() -> json(['message' => 'faild']);
    }
    public function uploadFile(Request $request) {
        $hospitalRequest = $request->file;
        $image = $request->file('fileName');
        $input = $hospitalRequest = $image->getClientOriginalName();
        $destinationPath = public_path('uploads/pdf_file/');
        $image->move($destinationPath, $input);
        return response()->json([
            'data' => asset('public/uploads/pdf_file/'.$input),
            'status' => true,
            'message' => 'success Message'
        ]);
    }
    public function rocata_file(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id',$patient->id)->update(
                ['rocata_file' => json_encode($request -> rocata_file)]
            );
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function rocata_fileGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> first();
            return response() -> json([
                'data' => $medicationGet->rocata_file,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function rays_file(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> update(
                ['rays_file' => json_encode($request -> rays_file)]
            );
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    // rays get file
    public function rays_fileGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> first();
            return response() -> json([
                'data' => $medicationGet->rays_file,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function analzes_file(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> update(
                ['analzes_file' => json_encode($request -> analzes_file)]
            );
            return response() -> json([
                'data' => $medicationGet,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function analzes_fileGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $medicationGet = patientData::where('patient_id', $patient -> id) -> first();
            return response() -> json([
                'data' => $medicationGet->analzes_file,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function raouchehsGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
            $raoucheh = Raoucheh::where('patient_id', $patient -> id) -> count();
            if ($raoucheh) {
                $raoucheh = Raoucheh::with ('online_doctor') -> where(
                        'patient_id',
                        $patient -> id
                    ) -> get();
                return response() -> json([
                    'data' => $raoucheh,
                    'message' => 'success'
                ]);
            } else {
                return response() -> json(['message' => 'faild'],400);
            }
        }
        return response() -> json(['message' => 'faild',400]);
    }
    public function forgotPassword(Request $request){
        $userRequest = $request->all();
            if($request->idCode[3] == '0'){
                $userRequest['idCode'] = substr_replace($request->idCode, '', 2, 1);
            }else{
                $userRequest['idCode'] = $request->idCode;
            }
        $patient = Patien::select('phoneNumber')->where('idCode',$userRequest['idCode'])->first();
        if($patient){
            return response()->json([
                'data' => $patient,
                'message' => 'The Number is exist in our record',
            ],200);
        }else{
            return response()->json([
                'message' => 'The Number is Not exist in our record,'
            ],404);
        }

    }
  public function confirm_password(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
          $patient -> password = bcrypt($request -> password);
          $patient -> update();
          return response() -> json([
              'message' => 'success'
          ]);
      }
      return response() -> json(['message' => 'patient Not found']);
  }
  public function postDonor(Request $request){
      $patient = Patien::where('idCode',$request->idCode)->first();
      if($patient){
       $donor = needDonor::create([
        'blood'   => $request->blood,
        'address'     => $request->address,
        'details'     => $request->details,
        'patientName' => $request->patientName,
        'fileName'    => $request->fileName,
        'latitude'   => $request->latitude,
        'longitude'  => $request->longitude,
        'patient_id'  => $patient->id,
       ]);
       return response()->json([
        'data' => $donor,
        'message' => 'success',
       ]);
      }
      return response()->json([
         'message' => 'faild',
      ]);
  }
  public function getDonor(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    $donor = needDonor::where('patient_id', $patient->id)->count();
    if($patient){
    if($donor){
    $donor = needDonor::where('patient_id', $patient->id)->get();
    return response()->json([
    'data' => $donor,
    'message' => 'success',
    ]);
    }}
    return response()->json([
       'message' => 'faild',
    ]);
}
public function donorRequest(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        $patientSender = Patien::where('idCode',$request->idSender)->first();

    if($patient){

        $request = requestDonor::create([
            'patientIdRequest' => $patient->id,
            'patientIdSender' => $patientSender->id,
            'donor_id' => $request->id,
        ]);
        return response()->json([
           'data' => $request,
           'message' => 'success',
        ]);
    }

    return response()->json([
      'message' => 'faild'
    ]);
 }
 public function donorAccept(Request $request){
    $patient = requestDonor::where('id',$request->id)->first();
    if($patient){
        $request = requestDonor::where('id',$request->id)->update([
            'accept' => $request->accept,
        ]);
        return response()->json([
        'data' => $request,
        'message' => 'success',
        ]);
    }
    return response()->json([
      'message' => 'faild'
    ]);
 }
 public function donorDecline(Request $request){
     $patient =requestDonor::where('id',$request->id)->first();
     if($patient){
        $request = requestDonor::where('id',$request->id)->where('accept',0)->delete();
        return response()->json([
        'data' => $request,
        'message' => 'success'
        ]);
        return response()->json([
          'message' => 'faild'
        ]);
     }
 }

 public function getdonorRequest(Request $request){
     $donor = Patien::where('idCode', $request->idCode)->first();
     if($donor){
         $request = requestDonor::where('accept',1)->where('patientIdRequest',$donor->id)->count();
         if($request){
            $request = requestDonor::where('accept',1)->where('patientIdRequest',$donor->id)->with(['donorForm','patient'])->get();
        return response()->json([
           'data' => $request,
           'message' => 'success',
        ]);
        }}
        return response()->json([
         'message' => 'faild',
        ]);

 }public function getdonorRequestList(Request $request){
    $donor = Patien::where('idCode', $request->idCode)->first();
    if($donor){
        $request = requestDonor::where('patientIdRequest',$donor->id)->count();
        if($request){
           $request = requestDonor::where('patientIdRequest',$donor->id)->with(['donorForm','patient'])->get();
        return response()->json([
            'data' => $request,
            'message' => 'success',
        ]);
       }}
       return response()->json([
        'message' => 'faild',
       ]);

}
 public function decideRequestBlood(Request $request){
    $don = Patien::where('idCode',$request->idCode)->first();
    if($don){
   $request = requestDonor::where('accept',0)->where('patientIdSender',$don->id)->count();
   if($request){
    $request = requestDonor::where('accept',0)->where('patientIdSender',$don->id)->with(['donorForm','patientRequest'])->get();
   return response()->json([
   'data' => $request,
   'message' => 'success',
   ]);
  }}
 return response()->json([
 'message' => 'faild',
  ]);

 }
    public function DonorsBloodSwitch(Request $request){
      $don = Patien::where('idCode',$request->idCode)->first();
      if($don){
        $req = $request->is_donor;
        $req['is_donor'] = 1;
      $donor = Patien::where('idCode',$request->idCode)->update($req);
     $blood = Donor::where('patient_id',$don->id)->create([
        'patient_id' => $don->id,
        'blood'=> $request->blood,
        'latitude' => $don->latitude,
        'longitude' => $don->longitude,
     ]);
      return response()->json([
      'data' => $donor,
      'message' => 'success',
        ]);
        }
        return response()->json([
        'message' =>'faild',

       ]);
       }

      public function DonorsBloodSwitchOff(Request $request){
      $don = Patien::where('idCode',$request->idCode)->first();
      if($don){
          $req = $request->is_donor;
        $req['is_donor'] = 0;
      $donor = Patien::where('idCode',$request->idCode)->update($req);
     $blood = Donor::where('patient_id',$don->id)->delete();
      return response()->json([
      'data' => $donor,
      'message' => 'success',
        ]);
        }

       return response()->json([
       'message' =>'faild',
        ]);
     }
     //get nearest blood donate
     public function index(Request $request ,$blood) {
        $specialties = $this -> getNearby($request , $blood);
        if ($specialties) {
            return response([
                'data' => $specialties,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed']);
        }
    }
     private function getNearby($request ,$blood ) {
        $latitudeTo = $request->latitude;
        $longitudeTo = $request->longitude;
        $earthRadius = 6378137; // earth radius it's fixed value 6378137
        $nearbySpecialties = [];
        $patient = Patien::where('idCode',$request->idCode)->first();
        $specialties = Donor::where('blood',$blood)->whereNotIn('patient_id',[$patient->id])
        ->with('patient')->get();
        foreach($specialties as $specialty) {
            $latitudeFrom = $specialty->latitude;
            $longitudeFrom = $specialty->longitude;
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
            $specialty -> distance = $distance;
            if ($distance > 500) {
                continue;
            }
            array_push($nearbySpecialties, $specialty);
        }
        if (count($nearbySpecialties)) {
            return $nearbySpecialties;
        }
    }
    //-------------------------------------------End Blood Donate-----------------------------------
    //add device donate
     public function medicalDevice(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
        $device = medicalDevices::create([
          'medicalDevicesName' => $request->medicalDevicesName,
          'medicalDevicesInformation' => $request->medicalDevicesInformation,
          'medicalDevicesImage' => $request->medicalDevicesImage,
          'medicalCategory' => $request->medicalCategory,
          'quantity' =>$request->quantity,
          'patient_id' => $patient->id,
        ]);
        return response()->json([
          'data' => $device,
          'message' => 'success',
        ]);
        }
        return response()->json([
        'message' => 'faild',
        ]);
     }
     //my device donate
     public function medicalDeviceGet(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
            $device = medicalDevices::where('patient_id',$patient->id)->count();
            if($device){
                $device = medicalDevices::where('patient_id',$patient->id)->get();
            return response()->json([
               'data' => $device,
               'message' => 'success'
            ]);
         } }
        return response()->json([
         'message' => 'faild',
        ]);
     }
     //search by name device expect current patient
     public function deviceSearchByName(Request $request){
         $name = medicalDevices::where('medicalCategory',$request->name)->count();
         if($name){
             $name = medicalDevices::where('medicalCategory',$request->name)->with('patient')->get();
             return response()->json([
                'data' => $name,
                'message' => 'success',
             ]);}
         return response()->json([
         'message' => 'faild',
         ]);
     }
     //post device request
     public function sendRequestDevice(Request $request){
         $patient = Patien::where('idCode',$request->idCode)->first();
         $patient2 = Patien::where('idCode',$request->idSender)->first();
         if($patient)
         {
        if($patient2){
            $request = DeviceRequest::create([
                'patientIdRequest' => $patient->id,
                'patientIdSender' => $patient2->id,
                'device_id' => $request->id,
                'quantity' => $request->quantity,
               ]);
               return response()->json([
                  'data' => $request,
                  'message' => 'success',
               ]);
        }}
             return response()->json([
            'message' => 'faild',
             ]);
     }
     //all device expect the device currnt patient
    public function allDevice(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    if($patient){
        $device = medicalDevices::whereNotIn('patient_id',[$patient->id])->count();
        if($device){
        $device = medicalDevices::whereNotIn('patient_id',[$patient->id])->with(['patient'])->get();
          return response()->json([
           'data'    => $device,
           'message' => 'success'
          ]);
        }}
        return response()->json([
            'message' => 'faild'
           ]);
    }
    public function decideRequestdevice(Request $request){
        $don = Patien::where('idCode',$request->idCode)->first();
        if($don){
       $request = DeviceRequest::where('accept',0)->where('patientIdSender',$don->id)->count();
       if($request){
        $request = DeviceRequest::where('accept',0)->where('patientIdSender',$don->id)->with(['donorForm','patientRequest'])->get();
       return response()->json([
       'data' => $request,
       'message' => 'success',
       ]);
      }}
     return response()->json([
     'message' => 'faild',
      ]);
     }
       // accept
       public function deviceAccept(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
            $medication = DeviceRequest::where('id',$request->id)
            ->where('patientIdSender',$patient->id)->first();
            if( $medication){
            $request = DeviceRequest::where('id',$request->id)
            ->where('patientIdSender',$patient->id)->update([
                'accept' => $request->accept,
            ]);

            return response()->json([
            'data' => $request,
            'message' => 'success',
            ]);
        }}
        return response()->json([
          'message' => 'faild'
        ]);
     }
     //delete request decline
     public function deviceDecline(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
            $medication = DeviceRequest::where('id',$request->id)
            ->where('patientIdSender',$patient->id)->where('accept',0)->first();
            if( $medication){
            $request = DeviceRequest::where('id',$request->id)
            ->where('patientIdSender',$patient->id)->where('accept',0)->delete();
            return response()->json([
            'data' => $request,
            'message' => 'success',
            ]);
        }}
        return response()->json([
          'message' => 'faild'
        ]);
     }
     public function getMyAcceptDevice(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
        $medication = DeviceRequest::where('patientIdRequest',$patient->id)
        ->where('accept',1)->count();
        if($medication){
        $medication = DeviceRequest::where('patientIdRequest',$patient->id)
        ->where('accept',1)->with(['patient','donorForm'])->get();
        return response()->json([
        'data' => $medication,
        'message'=> 'success'
        ]);
        }}
        return response()->json([
        'message' => 'faild'
        ]);
      }
      public function updateQuantityDevice(Request $request){
        $patient = medicalDevices::where('id',$request->id)->first();
        if($patient){
            $medication = medicalDevices::where('id',$request->id)->update([
                 'quantity' => $request->quantity,
                 ]);
            return response()->json([
                'data' => $medication,
                'message' => 'success',
            ]);
        }
        return response()->json([
           'message' => 'faild',
        ]);
    }
    //my requested to patientRequester
    public function getMyDeviceRequest(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
            $medication = DeviceRequest::where('patientIdRequest',$patient->id)->count();
            if($medication){
                $medication = DeviceRequest::where('patientIdRequest',$patient->id)
                ->with(['donorForm','patient'])->get();
                return response()->json([
                    'data' => $medication,
                    'message' => 'success',
                ]);
            }}
           return response()->json([
            'message' => 'faild'
           ]);
    }
    //------------------------------------------------End Device Donate-----------------------------
    //medication donate
     public function medicationDonor(Request $request){
         $patient = Patien::where('idCode',$request->idCode)->first();
         if($patient){
             $medication = Medication::create([
                  'medicationName' => $request->medicationName,
                  'medicationInformation' => $request->medicationInformation,
                  'medicationImage' => $request->medicationImage,
                  'quantity' => $request->quantity,
                  'patient_id' => $patient->id,
             ]);
             return response()->json([
                 'data' => $medication,
                 'message' => 'success',
             ]);
         }
         return response()->json([
            'message' => 'faild',
         ]);
     }

     //update quantity
     public function updateQuantity(Request $request){
        $patient = Medication::where('id',$request->id)->first();
        if($patient){
            $medication = Medication::where('id',$request->id)->update([
                 'quantity' => $request->quantity,
                 ]);
            return response()->json([
                'data' => $medication,
                'message' => 'success',
            ]);
        }
        return response()->json([
           'message' => 'faild',
        ]);
    }
    // deletemedicationDonor function
    public function deletemedicationDonor(Request $request){
        $medication = Medication::where('id',$request->id)->first();
         if($medication){
             $medication = Medication::where('id',$request->id)->delete();
             return response()->json([
              'data' => $medication,
              'message' =>'success'
             ]);
         }
         return response()->json([
              'message' => 'faild'
         ]);
    }
    //my donor medication
     public function getMyDonorMedication(Request $request){
         $patient = Patien::where('idCode',$request->idCode)->first();
         if($patient){
             $medication = Medication::where('patient_id',$patient->id)->count();
             if($medication){
                $medication = Medication::where('patient_id',$patient->id)->get();
                return response()->json([
                 'data' => $medication,
                 'message' => 'success'
                ]);
             }}
             return response()->json([
                'message' => 'faild',
             ]);
     }
     //all medication expect current patient
     public function getAllMedication(Request $request){

        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
         $medication = Medication::whereNotIn('patient_id',[$patient->id])->count();
        if($medication){
         $medication = Medication::whereNotIn('patient_id',[$patient->id])->with('patient')->get();
                return response()->json([
                 'data' => $medication,
                 'message' => 'success'
                ]);
             }}
             return response()->json([
                'message' => 'faild',
             ]);
     }

     //search by name medication
     public function medicationDonorGet(Request $request){
         $donor = Medication::where('medicationName',$request->name)->count();
         if($donor){
             $donors = Medication::where('medicationName',$request->name)->with('patient')->get();
             return response()->json([
              'data' => $donors,
              'message' => 'success'
             ]);
         }
         return response()->json([
         'message' => 'faild',
         ]);
     }
    //post request
     public function medicationRequest(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
         $patientSender = Patien::where('idCode',$request->idSender)->first();
        if($patient){
            $request = medicationRequest::create([
             'patientIdRequest' => $patient->id,
              'patientIdSender' => $patientSender->id,
             'medication_id' => $request->id,
             'quantity' => $request->quantity,
            ]);
            return response()->json([
               'data' => $request,
               'message' => 'success',
            ]);
        }
        return response()->json([
          'message' => 'faild'
        ]);
     }
     // medicationAccept
     public function medicationAccept(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
            $medication = medicationRequest::where('id',$request->id)
            ->where('patientIdSender',$patient->id)->first();
            if( $medication){
            $request = medicationRequest::where('id',$request->id)
            ->where('patientIdSender',$patient->id)->update([
                'accept' => $request->accept,
            ]);
            return response()->json([
            'data' => $request,
            'message' => 'success',
            ]);
        }}
        return response()->json([
          'message' => 'faild'
        ]);
     }
     //delete request decline
     public function medicationDecline(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
            $medication = medicationRequest::where('id',$request->id)
            ->where('patientIdSender',$patient->id)->where('accept',0)->first();
            if( $medication){
            $request = medicationRequest::where('id',$request->id)
            ->where('patientIdSender',$patient->id)->where('accept',0)->delete();
            return response()->json([
            'data' => $request,
            'message' => 'success',
            ]);
        }}
        return response()->json([
          'message' => 'faild'
        ]);
     }

     //my list accept medication
    public function getMyAcceptMedication(Request $request){
       $patient = Patien::where('idCode',$request->idCode)->first();
       if($patient){
       $medication = medicationRequest::where('patientIdRequest',$patient->id)
       ->where('accept',1)->count();
       if($medication){
       $medication = medicationRequest::where('patientIdRequest',$patient->id)
       ->where('accept',1)->with(['patient','donorForm'])->get();
       return response()->json([
       'data' => $medication,
       'message'=> 'success'
       ]);
       }}
       return response()->json([
       'message' => 'faild'
       ]);
     }
     //my requested to patientRequester
    public function getMyMedictionRequest(Request $request){
         $patient = Patien::where('idCode',$request->idCode)->first();
         if($patient){
             $medication = medicationRequest::where('patientIdRequest',$patient->id)->count();
             if($medication){
                 $medication = medicationRequest::where('patientIdRequest',$patient->id)
                 ->with(['donorForm','patient'])->get();
                 return response()->json([
                     'data' => $medication,
                     'message' => 'success',
                 ]);
             }}
            return response()->json([
             'data' => 'faild'
            ]);
     }
     //list of request to decide whether accept or decline
     public function decideRequestMedication(Request $request){
        $don = Patien::where('idCode',$request->idCode)->first();
        if($don){
       $request = medicationRequest::where('accept',0)->where('patientIdSender',$don->id)->count();
       if($request){
        $request = medicationRequest::where('accept',0)->where('patientIdSender',$don->id)->with(['donorForm','patientRequest'])->get();
       return response()->json([
       'data' => $request,
       'message' => 'success',
       ]);
      }}
     return response()->json([
     'message' => 'faild',
      ]);
     }

     //-----------------------------------------------Medication Donate----------------------------//
     public function patientCar(Request $request){
         $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
          $car = patientCar::create([
           'ampulanceType' => $request->ampulanceType,
           'patientName' => $request->patientName,
           'phoneNumber' => $request->phoneNumber,
           'date'   => $request->date,
           'address' => $request->address,
           'addressDist' => $request->addressDist,
           'carType' => $request->carType,
           'PurposeOfTheTipe' => $request->PurposeOfTheTipe,
           'requireQues' => $request->requireQues,
           'patient_id' => $patient->id,
          ]);
          return response()->json([
          'data' => $car,
          'message' => 'success',
          ]);
        }
        return response()->json([
        'message'=>'faild'
        ]);
     }
     public function patientCarGet(Request $request){
         $patient = Patien::where('idCode',$request->idCode)->first();
         if($patient){
         $car = patientCar::where('patient_id',$patient->id)->count();
         if($car){
          $car = patientCar::where('patient_id',$patient->id)->get();
          return response()->json([
          'data' => $car,
          'message' => 'success',
          ]);
         }}
         return response()->json([
          'message' => 'faild',
         ]);
     }
    public function pcrCovid(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
                $request = covidPcr::create([
                    'link' => $request -> link,
                    'patient_id' => $patient->id
                  ]);
                  return response()->json([
                    'data' => $request,
                    'message' => 'success',
                   ]);}

    return response()->json([
         'message' => 'faild',
    ]);
}
public function vacCovid(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    if($patient){
            $request = covidVac::create([
                'link' => $request->link,
                'patient_id' => $patient->id,
              ]);
              return response()->json([
                'data' => $request,
                'message' => 'success',
               ]);}
            return response()->json([
            'message' => 'faild',
            ]);
}
public function formCovid(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    if($patient){
    $request = covidCountry::create([
      'from' => $request->from,
      'to' => $request->to,
    ]);
    return response()->json([
     'data' => $request,
     'message' => 'success',
    ]);
}
return response()->json([
     'message' => 'faild',
]);
}
public function toCovid(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    if($patient){
    $request = covidCountry::create([
      'to' => $request->to,
    ]);
    return response()->json([
     'data' => $request,
     'message' => 'success',
    ]);
}
return response()->json([
     'message' => 'faild',
]);
}
public function updateIdCode(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    if($patient){
    $hospitalRequest = $request -> all();
    $hospitalRequest['idCode'] = $request-> phoneNumber;
    $hospitalRequest['phoneNumber'] = str_replace(
            'P',
            '+',
            $hospitalRequest['idCode']
        );
        $hospitalCreate = Patien::where('idCode',[$hospitalRequest['idCode']])->exists();
        if(!$hospitalCreate){
             $update = Patien::where('idCode',$request->idCode)->update($hospitalRequest);
         return response()->json([
         'message' => 'success'
        ]);
    }}
    return response()->json([
     'message' => 'faild'
    ]);
}
public function updateImage(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    if($patient){
        $image = Patien::where('idCode',$patient->idCode)->update([
         'image' => $request->image,
        ]);
        return response()->json([
         'data' => $image,
         'message' => 'success'
        ]);
    }
    return response()->json([
     'message' => 'faild'
    ]);
}
    public function updateState(Request $request){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
        $hospitalRequest = $request -> all();
        $hospitalRequest['email'] = $request-> email;
        $check = Patien::where('email',[$hospitalRequest['email']])->exists();
        if(!$check){
        $patient->update($request -> except($request->idCode));
            return response()->json([
            'data' => $patient,
            'mesaage' => 'success'
            ]);
        }}
        return response()->json([
        'message' => 'faild'
        ]);
    }
    // efelate register patient
    public function efelate_post_Register(Request $request){
        $dataa = (object)[];
        $efelate = Patien::where('id',$request->id)->first();
        $request_data = $request->all();
        $validator = Validator::make($request_data, [
            'image' => 'max:3071',
            'firstName' => 'required',
            'middleName' => '',
            'lastName' => '',
            'BirthDate' => 'required',
            'idCode' => 'required|unique:patiens',
            'gender' => 'required',
            'email' => 'email|unique:patiens',
            'password' => 'required|confirmed',
            'password_confirmation' => 'sometimes|required_with:password',
            'state' => 'required',
            'job' => '',
            'race' => '',
            'address' => 'required',
            'latitude' => '',
            'longitude' => ''
        ]);
        if ($validator -> fails()) {
            return response([
                'error' => $validator -> errors(),
            ]);
        }
        $request_data['image'] = $request->image;
        $request_data['password'] = bcrypt($request->password);
            if($request->phoneNumber[0] == '0'){
                $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            $request_data['role'] = 'patient';
            $request_data['is_active'] = false;
            $patientPhone = Patien::where('phoneNumber',$request_data['phoneNumber'])->first();
            if(!$patientPhone){
                $efelate->poients = $efelate->poients + 5;
                $efelate->save();
                $clupTransctionCreate = clupTransaction::create([
                    'transaction'  => 'Invite Patient',
                    'point'        => 5,
                    'balance'      => $efelate->poients,
                    'patient_id'   => $efelate->id,
                ]);
                $patientCreate = Patien::create($request_data);
                return response()->json([
                    'data' => $patientCreate,
                    'clupTransction'    => $clupTransctionCreate,
                    'status' => true,
                    'message' => 'success',
                ]);
            }
            return response()->json([
                'data' => $dataa,
                'clupTransction'    => $dataa,
                'status' => false,
                'message' => 'phoneNumber is Exists!',
            ]);
            // return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);

    }

    public function getBasicDate(Request $request){
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
    }

    public function editProfile(Request $request){
        try{
            $requestData = $request->all();
            $validator = Validator::make($requestData, [
                'idCode' => 'required',
                'email' => 'email|required',
                'state' => 'required',
                'job' => '',
                'race' => '',
                'address' => 'required',
                'countryCode' => 'required',
                'phoneNumber' => 'required'
            ]);
            if ($validator -> fails()) {
                foreach($validator->errors()->toArray() as $e){
                    return response()->json([
                        'message' => $e,
                        'status' => false,
                    ],400);
                }
            }
            $patient = Patien::where('idCode',$request->idCode)->first();
            if($patient){
                if($request->phoneNumber[0] == '0'){
                    $requestData['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
                }else{
                    $requestData['phoneNumber'] = $request->countryCode . $request->phoneNumber;
                }
                $patient->phoneNumber = $requestData['phoneNumber'];
                $patient->email = $request->email;
                $patient->address = $request->address;
                $patient->race = $request->race;
                $patient->state = $request->state;
                $patient->job = $request->job;
                $patient->idCode = str_replace('+','P',$requestData['phoneNumber']);
                $patient->save();
                return response()->json([
                    'message' => 'updated successfuly',
                    'status' => true
                ]);
            }else{
                return response()->json([
                    'message' => 'patient not found',
                    'status' => false
                ],400);
            }
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],400);
        }
    }
}
