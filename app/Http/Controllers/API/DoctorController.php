<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\OnlineDoctor;
use App\models\Patien;
use App\models\Raoucheh;
use App\models\Appointment;
use App\models\patient_rays;
use App\models\patient_analzes;
use App\models\Donor;
use App\models\patientData;
use App\models\QrDoctor;
use App\models\Rate;
use App\models\familyDoctor;
use App\models\DoctorScudule;
use App\models\Hosptail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\models\Child;
class DoctorController extends Controller
{
public function register(Request $request) {
    try{
        $doctorRequest = $request->all();
        $validator = Validator::make($doctorRequest, [
            'image' => 'max:3072',
            'name' => 'required',
            'phoneNumber' => 'required|unique:online_doctors,phoneNumber',
            'countryCode' => 'required',
            'password' => 'required|confirmed',
            'license_number' => 'required',
            'email' => 'email',
            'password' => 'required',
            'speciality' => 'required',
            'degree' => 'required',
            'information' => '',
            'national_id_front_side' => 'max:2048',
            'national_id_back_side' => 'max:2048',
            'degree_image' => 'max:2048',
            'license_image' => 'max:2048',
            'branch' => '',
            'Nationality' => '',
            'address' => '',
            'latitude' => '',
            'longitude' => ''
        ]);
        if($validator->fails()) {
            return response([
                'message' => $validator->errors()->all(),
                'status' => false,
            ],400);
        }
        $doctorRequest['password'] = bcrypt($request -> password);
        $doctorRequest['image'] = $request->image;
        if($request->phoneNumber[0] == '0'){
            $doctorRequest['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
        }else{
            $doctorRequest['phoneNumber'] = $request->countryCode . $request->phoneNumber;
        }
        $doctorRequest['idCode'] = str_replace('+', 'D', $doctorRequest['phoneNumber']);
        $doctorRequest['is_active'] = true;
        if ($doctorRequest['speciality'] == 'General') {
            $doctorRequest['speciality_id'] = 1;
        }
        elseif ($doctorRequest['speciality'] == 'Audiologist') {
            $doctorRequest['speciality_id'] = 2;
        }
        elseif($doctorRequest['speciality'] == 'Anesthesiologist') {
            $doctorRequest['speciality_id'] = 3;
        }
        elseif($doctorRequest['speciality'] == 'Andrologists') {
            $doctorRequest['speciality_id'] = 4;
        }
        elseif($doctorRequest['speciality'] == 'Cardiologist') {
            $doctorRequest['speciality_id'] = 5;
        }
        elseif($doctorRequest['speciality'] == 'Cardiovascular') {
            $doctorRequest['speciality_id'] = 6;
        }
        elseif($doctorRequest['speciality'] == 'Cardiovascular Surgery') {
            $doctorRequest['speciality_id'] = 7;
        }
        elseif($doctorRequest['speciality'] == 'Neurologist') {
            $doctorRequest['speciality_id'] = 8;
        }
        elseif($doctorRequest['speciality'] == 'Dentist') {
            $doctorRequest['speciality_id'] = 9;
        }
        elseif($doctorRequest['speciality'] == 'Dermatologist') {
            $doctorRequest['speciality_id'] = 10;
        }
        elseif($doctorRequest['speciality'] == 'Emergency Doctors') {
            $doctorRequest['speciality_id'] = 11;
        }
        elseif($doctorRequest['speciality'] == 'Endocrinologist') {
            $doctorRequest['speciality_id'] = 12;
        }
        elseif($doctorRequest['speciality'] == 'Gynecologist') {
            $doctorRequest['speciality_id'] = 13;
        }
        elseif($doctorRequest['speciality'] == 'Hematology') {
            $doctorRequest['speciality_id'] = 14;
        }
        elseif($doctorRequest['speciality'] == 'Hepatologists') {
            $doctorRequest['speciality_id'] = 15;
        }
        elseif($doctorRequest['speciality'] == 'Orthopdist') {
            $doctorRequest['speciality_id'] = 16;
        }
        elseif($doctorRequest['speciality'] == 'Pediatrician') {
            $doctorRequest['speciality_id'] = 17;
        }
        elseif($doctorRequest['speciality'] == 'Plastic Surgeon') {
            $doctorRequest['speciality_id'] = 18;
        }
        elseif($doctorRequest['speciality'] == 'Surgeon') {
            $doctorRequest['speciality_id'] = 19;
        }
        elseif($doctorRequest['speciality'] == 'Urologist') {
            $doctorRequest['speciality_id'] = 20;
        }
        elseif($doctorRequest['speciality'] == 'Rheumatologist') {
            $doctorRequest['speciality_id'] = 21;
        }
        elseif($doctorRequest['speciality'] == 'Ophthalmologist') {
            $doctorRequest['speciality_id'] = 22;
        }
        elseif($doctorRequest['speciality'] == 'General Practitioner') {
            $doctorRequest['speciality_id'] = 23;
        }
        elseif($doctorRequest['speciality'] == 'Ear , Nose and Throat') {
            $doctorRequest['speciality_id'] = 24;
        }
        elseif($doctorRequest['speciality'] == 'Endoscopic Surgeon') {
            $doctorRequest['speciality_id'] = 25;
        }
        elseif($doctorRequest['speciality'] == 'Laboratory & Analytical') {
            $doctorRequest['speciality_id'] = 26;
        }
        elseif($doctorRequest['speciality'] == 'Pharmacist') {
            $doctorRequest['speciality_id'] = 27;
        }
        elseif($doctorRequest['speciality'] == 'Oncologist') {
            $doctorRequest['speciality_id'] = 28;
        }
        else{
            $doctorRequest['speciality_id'] = 29;
        }
        $doctorCreate = OnlineDoctor::create($doctorRequest);
        $success['token'] = $doctorCreate->createToken('MyApp')->accessToken;
        if ($doctorCreate) {
            return response() -> json([
                'data' => $doctorCreate,
                'message' => 'success',
                'token' => $success['token']
            ]);
        }
    }catch(\Exception $ex){
        return response()->json([
            'message' => $ex->getMessage(),
            'status' => false
        ],500);
    }
}
    public function login(Request $request) {
        if (Auth::guard('online_doctor')->attempt([
            'idCode' => $request->idCode,
            'password' => $request->password
        ])) {
            $user = Auth::guard('online_doctor')->user();
            $success['token'] = $user -> createToken('MyApp')->accessToken;
            return response() -> json([
                'data' => $user,
                'message' => 'success',
                'token' => $success['token']
            ]);
        } else {
            return response() -> json(['error' => 'Unauthorised'], 401);
        }
    }
    public function raouchehs(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if($patient){
        $doctor = OnlineDoctor::where('idcode', $request -> id) -> first();
            if ($doctor) {
                $raoucheh = Raoucheh::create([
                    'weight' => $request -> weight,
                    'prescription' => $request -> prescription,
                    'temperature' => $request -> temperature,
                    'blood_pressure' => $request -> blood_pressure,
                    'diabetics' => $request -> diabetics,
                    'jaw_type' => $request -> jaw_type,
                    'date' => $request -> date,
                    'jaw_direction' => $request -> jaw_direction,
                    'teeth_type' => $request -> teeth_type,
                    'eye_type' => $request -> eye_type,
                    'medication' => $request -> medication,
                    'online_doctor_id' => $doctor -> id,
                    'patient_id' => $patient -> id
                ]);
                return response() -> json([
                    'data' => $raoucheh,
                    'message' => 'success'
                ]);
            }}
            return response() -> json(['message' => 'faild'],400);
    }
    public function searchPatient(Request $request) {
        try{
            $patient = Patien::where('idCode',$request->idCode)
            ->where('online', 1)
            ->with(['childern'])
            ->first();
            if($patient){
                return response() -> json([
                    'data' => $patient,
                    'message' => 'success message',
                    'status' => true
                ]);
            }
            return response()->json([
                'message' => 'patient not found',
                'status' => false,
            ],400);
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false,
            ],500);
        }
    }
    public function raouchehsGet(Request $request) {
        $patient = Patien::where('idCode', $request -> idCode) -> first();
        if ($patient) {
        $doctor = OnlineDoctor::where('idcode', $request -> id) -> first();
            if ($doctor) {
                $raoucheh = Raoucheh::with ('online_doctor') -> where(
                        'patient_id',
                        $patient -> id
                    ) -> where('online_doctor_id', $doctor -> id) -> get();
                return response() -> json([
                    'data' => $raoucheh,
                    'message' => 'success'
                ]);
            }
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function switchOn(Request $request) {
        try{
            $online_doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
            if($online_doctor){
                $online_doctor->online = $request->online;
                $online_doctor->save();
                return response()->json([
                    'message' => 'online updated',
                    'status' => true,
                ]);
            }
            return response()->json([
                'message' => 'Doctor Not found',
                'status' => false,
            ],400);
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],500);
        }
    }
    // public function switchOf(Request $request, $idCode) {
    //     $reqdata = $request -> all();
    //     $reqdata['online'] = 0;
    //     $lesson = OnlineDoctor::where('idCode', $request->idCode) -> update($reqdata);
    //     return response() -> json(['success' => $lesson]);
    // }
    public function searchDoctor(Request $request) {
        $patient = OnlineDoctor::where('idCode', $request->idCode) -> first();
        if ($patient) {
            return response() -> json([
                'data' => $patient,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function getAllDoctor() {
        $doctors = OnlineDoctor::where('speciality','General')->get();
        if ($doctors -> count() == 0) {
            return response() -> json(['message' => 'faild'],400);
        }
        return response() -> json([
            'data' => $doctors,
            'message' => 'success'
        ]);
    }
    public function rayPatient(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
            $doctor = OnlineDoctor::where('idcode', $request->id) -> first();
            if ($doctor){
                $rocata = patient_rays::create([
                    'ray_name' => $request->ray_name,
                    'patient_id' => $patient->id,
                    'online_doctor_id'=>$doctor->id,
                    'link' => $request->link,
                    'date' => $request->date
                ]);
                return response() -> json([
                    'data' => $rocata,
                    'message' => 'success'
                ]);
            }
        }
        return response() -> json(['message' => 'faild'],400);
    }
  public function rayPatientUpdate(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if($patient){
        $doctor = OnlineDoctor::where('idcode', $request->id) -> first();
        if($doctor){
                $rocata1 =patient_rays::where('id', $request->ID) -> where(
                    'online_doctor_id',
                    $doctor->id
                ) -> where('patient_id', $patient->id)->first();
                if($rocata1){
                $rocata1 =patient_rays::where('id', $request->ID) -> where(
                    'online_doctor_id',
                    $doctor->id
                ) -> where('patient_id', $patient->id)->update(['link' => json_encode($request -> link)]);
                return response() -> json([
                    'data' => $rocata1,
                    'message' => 'success'
                ]);
            }}
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function rayPatientGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
        $doctor = OnlineDoctor::where('idcode', $request->id) -> first();
            if ($doctor) {
                $rocata = patient_rays::with ('online_doctor') -> where(
                        'patient_id',
                        $patient->id
                    ) -> where('online_doctor_id', $doctor->id) -> count();
                    if($rocata){
                        $rocata = patient_rays::with ('online_doctor') -> where(
                            'patient_id',
                            $patient->id
                        ) -> where('online_doctor_id', $doctor->id) -> get();
                return response() -> json([
                    'data' => $rocata,
                    'message' => 'success'
                ]);
            }}}
        return response() -> json(['message' => 'faild']);
    }
    public function rayAllPatientGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
            $rocata = patient_rays::with ('online_doctor') -> where(
                    'patient_id',
                    $patient->id
                ) -> count();
                if($rocata){
                    $rocata = patient_rays::with ('online_doctor') -> where(
                        'patient_id',
                        $patient->id
                    ) -> get();
            return response() -> json([
                'data' => $rocata,
                'message' => 'success'
            ]);
        }}
        return response() -> json(['message' => 'faild']);
    }
    public function rayLastPatientGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
            $rocata = patient_rays::with ('online_doctor') -> where(
                    'patient_id',
                    $patient->id
                ) -> latest() -> count();
                if($rocata){
                    $rocata = patient_rays::with ('online_doctor') -> where(
                        'patient_id',
                        $patient->id
                    ) -> latest() -> get();
            return response() -> json([
                'data' => $rocata,
                'message' => 'success'
            ]);
        }}
        return response() -> json(['message' => 'faild']);
    }
    public function testPatient(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
        $doctor = OnlineDoctor::where('idcode', $request->id) -> first();
        if ($doctor) {
                $rocata = patient_analzes::create([
                    'test_name' => $request->test_name,
                    'patient_id' => $patient->id,
                    'online_doctor_id' => $doctor->id,
                    'link' => $request->link,
                    'date' => $request->date
                ]);
                return response() -> json([
                    'data' => $rocata,
                    'message' => 'success'
                ]);
            }
        }
        return response() -> json(['message' => 'faild']);
    }
    public function testPatientGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
        $doctor = OnlineDoctor::where('idcode', $request->id) -> first();
            if ($doctor) {
                $rocata = patient_analzes::with ('online_doctor') -> where(
                        'patient_id',
                        $patient->id
                    ) -> where('online_doctor_id', $doctor->id) -> count();
              if($rocata){
                $rocata = patient_analzes::with ('online_doctor') -> where(
                    'patient_id',
                    $patient->id
                ) -> where('online_doctor_id', $doctor->id) -> get();
                    return response() -> json([
                    'data' => $rocata,
                    'message' => 'success'
                ]);
            }
        }}
        return response() -> json(['message' => 'faild']);
    }
    public function testPatientAllGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
            $rocata = patient_analzes::with ('online_doctor') -> where(
                    'patient_id',
                    $patient -> id
                ) -> count();
                if($rocata){
                $rocata = patient_analzes::with ('online_doctor') -> where(
                        'patient_id',
                        $patient -> id
                    ) -> get();
            return response() -> json([
                'data' => $rocata,
                'message' => 'success'
            ]);
        }}
        return response() -> json(['message' => 'faild']);
    }
    public function testPatientLastGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
            $rocata = patient_analzes::with ('online_doctor') -> where(
                    'patient_id',
                    $patient -> id
                ) -> latest() -> first();
                if($rocata){
                    $rocata = patient_analzes::with ('online_doctor') -> where(
                        'patient_id',
                        $patient -> id
                    ) -> latest() -> first();
            return response() -> json([
                'data' => $rocata,
                'message' => 'success'
            ]);
        }}
        return response() -> json(['message' => 'faild']);
    }
    public function rayTestUpdate(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
        $doctor = OnlineDoctor::where('idcode', $request->id) -> first();
        if ($doctor) {
        $rocata = patient_analzes::where('id', $request->ID) -> where(
            'online_doctor_id',
            $doctor->id
        ) -> where('patient_id', $patient->id) -> first();
            if($rocata){
                $rocata -> update(['link' => $request->link]);
                return response() -> json([
                    'data' => $rocata,
                    'message' => 'success'
                ]);
            }}
        }
        return response() -> json(['message' => 'faild']);
    }
   public function getOnlineDoctor(Request $request) {
        $doctor = OnlineDoctor::where('speciality', $request->speciality) -> count();
        if ($doctor) {
            $doctor1 = OnlineDoctor::where('speciality', $request->speciality) -> where(
                'online',
                1
            ) -> count();
            if($doctor1){
            $doctor = OnlineDoctor::where('speciality', $request->speciality) -> where(
                'online',
                1
            ) -> get();
            return response() -> json([
                'data' => $doctor,
                'message' => 'success'
            ]);
        }}
        return response() -> json(['message' => 'faild']);
    }
    // public function getHomecareDoctor(Request $request) {
    //     $doctor = OnlineDoctor::where('speciality', $request->speciality) -> count();
    //     if ($doctor) {
    //         $doctor1 = OnlineDoctor::where('speciality', $request->speciality) -> where(
    //             'homecare',
    //             1
    //         ) -> count();
    //         if($doctor1){
    //         $doctor = OnlineDoctor::where('speciality', $request->speciality) -> where(
    //             'homecare',
    //             1
    //         ) -> get();
    //         return response() -> json([
    //             'data' => $doctor,
    //             'message' => 'success'
    //         ]);
    //     }}
    //     return response() -> json(['message' => 'faild']);
    // }
    public function confirm_password(Request $request) {
        $patient = OnlineDoctor::where('idCode', $request->idCode) -> first();
        if ($patient) {
            $patient->password = bcrypt($request->password);
            $patient->update();
            return response() -> json([
                'data' => $patient,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild']);
    }
    public function store(Request $request) {
        try{
            $patient = OnlineDoctor::where('idCode', $request ->idCode) -> first();
            if ($patient) {
                $doctor = Appointment::where('doctor_id', $patient ->id) -> where(
                    'longitude',
                    $request ->longitude
                ) -> where('latitude', $request->latitude) -> first();
                if ($doctor == false) {
                    $doctor = Appointment::create([
                        'doctor_name'    => $request->doctor_name,
                        'latitude'       => $request->latitude,
                        'longitude'      => $request->longitude,
                        'address'        => $request->address,
                        'phoneNumber'    => $request->phoneNumber,
                        'fees'           => $request->fees,
                        'wating'         => $request->wating,
                        'special'        => $request->special,
                        'appointments'   => $request->appointments,
                        'idCode'         => $request->idCode,
                        'doctor_id'      => $patient->id
                    ]);
                    return response([
                        'data' => $doctor,
                        'message' => 'success',
                        'status' => true
                    ]);
                } else {
                    $doctor -> update(['appointments' => $request->appointments]);
                    return response([
                        'data' => $doctor,
                        'message' => 'success',
                        'status' => true
                    ]);
                }
            }
            return response([
                'message' => 'faild message',
                'status' => false
            ],400);
        }catch (\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],500);
        }

    }
    public function switchIsHomecara(Request $request) {
        try{
            $homecare = OnlineDoctor::where('idCode',$request->idCode)->first();
            if($homecare){
                $homecare = OnlineDoctor::where('idCode',$request->idCode)-> update(
                ['homecare' => $request->homecare]
                );
                return response() -> json([
                    'message' => 'homecare updated',
                    'status' => true,
                ]);
            }
            return response([
                'message' => 'doctor not found',
                'status' => false,
            ],400);
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false,
            ],500);
        }
    }
    public function switchIsHomecareGet(Request $request) {
        $lesson = OnlineDoctor::where('idCode', $request->idCode) -> count();
        if ($lesson) {
            $lesson = OnlineDoctor::where('idCode', $request->idCode) -> get('homecare');
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
    private function getNearby($request ) {
        $latitudeTo = $request->latitude;
      $longitudeTo = $request->longitude;
      $specialty = $request->name;
      $earthRadius = 6378137; // earth radius it's fixed value 6378137

      $nearbyDoctors = [];

      $doctors = Appointment::where('special', 'LIKE', $request->name.'%')->get();

      foreach ($doctors as $doctor) {
          $latitudeFrom = $doctor->latitude;
          $longitudeFrom = $doctor->longitude;
          // convert from degrees to radians
          $latFrom = deg2rad($latitudeFrom);
          $lonFrom = deg2rad($longitudeFrom);
          $latTo = deg2rad($latitudeTo);
          $lonTo = deg2rad($longitudeTo);

          $latDelta = $latTo - $latFrom;
          $lonDelta = $lonTo - $lonFrom;

          $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                  cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
          $distance = round($angle * $earthRadius);
//            $distance = $distance >= 1000 ? (round($distance/1000, 2)) : $distance;
          $doctor->distance = $distance;

          if ($distance > 500){
              continue;
          }
          array_push($nearbyDoctors, $doctor);
      }

      if (count($nearbyDoctors)) {
          return $nearbyDoctors;
      }

  }
    public function getHomecareDoctor(Request $request) {
        $specialties = $this -> getNearby1($request);
        if ($specialties) {
            return response([
                'data' => $specialties,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed']);
        }
    }
     private function getNearby1($request ) {
          $latitudeTo = $request->latitude;
        $longitudeTo = $request->longitude;
        $specialty = $request->name;
        $earthRadius = 6378137; // earth radius it's fixed value 6378137

        $nearbyDoctors = [];

        $doctors = OnlineDoctor::where('speciality', 'LIKE', $request->name.'%')->where('homecare',1)->get();

        foreach ($doctors as $doctor) {
            $latitudeFrom = $doctor->latitude;
            $longitudeFrom = $doctor->longitude;

            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            $distance = round($angle * $earthRadius);
//            $distance = $distance >= 1000 ? (round($distance/1000, 2)) : $distance;
            $doctor->distance = $distance;

            if ($distance > 500){
                continue;
            }
            array_push($nearbyDoctors, $doctor);
        }

        if (count($nearbyDoctors)) {
            return $nearbyDoctors;
        }

    }
    public function searchDoctorName(Request $request) {
        $homecare = Appointment::where('doctor_name', 'LIKE', '%'.$request->name.'%') -> count();
        if ($homecare) {
            $homecare1 = Appointment::where(
                'doctor_name',
                'LIKE',
                '%'.$request -> name.'%'
            ) -> get();
            return response() -> json([
                'data' => $homecare1,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function searchDoctorWork(Request $request) {
        $patient = Appointment::where('idCode', $request->idCode) -> count();
        if ($patient) {
            $patient = Appointment::where('idCode', $request->idCode) -> get();
            return response() -> json([
                'data' => $patient,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function QrDoctor(Request $request) {
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
        $qr = QrDoctor::where('idPatient',$request ->idCode)->first();
        if(!$qr){
        $qr = QrDoctor::create([
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
    public function QrDoctorGet(Request $request) {
        $qr = QrDoctor::where([
            'idEnterprise' => $request -> id
        ]) -> count();
        if ($qr) {
            $qr = QrDoctor::where([
                'idEnterprise' => $request -> id
            ]) -> get();
            return response() -> json([
                'data' => $qr,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'failed'],400);
    }
    // function create book to doctor
    public function createBook(Request $request) {

        $patient = Patien::where('idCode', $request->idCode)->first();
        if($patient){
        $appointment = Appointment::where('id', $request->appId)->first();
        if ($appointment) {
            $book = DoctorScudule::create([
                'patient_name'   =>$request->patient_name,
                'patient_phone'  =>$request->patient_phone,
                'time'           =>$request->time,
                'appoiment_id'   =>$appointment->id,
                'patient_id'     =>$patient->id
            ]);
            return response() -> json([
            'data' => $book,
            'message' => 'success'
            ]);
        }}
        return response() -> json(['message' => 'faild'],400);
    }
    public function createBookGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if ($patient) {
            $book = DoctorScudule::where('patient_id', $patient->id)->count();
            if ($book) {
                $books = DoctorScudule::with (['appoiment' => function($q){
                    $q->with('doctor');
                }]) -> where(
                        'patient_id',
                        $patient -> id
                    ) -> get();
                return response() -> json([
                    'data' => $books,
                    'message' => 'success'
                ]);
            }
        }
        return response() -> json(['message' => 'faild'],400);
    }
    public function doctorBook(Request $request) {
        $doctor = Appointment::where('idCode', $request->idCode) -> first();
        if ($doctor) {
            $appoinment = DoctorScudule::where('appoiment_id', $request->appId) -> count();
            if($appoinment){
                $appoinment = DoctorScudule::where('appoiment_id', $request->appId) -> get();
            return response() -> json([
                'data' => $appoinment,
                'message' => 'success'
            ]);
        }}

        return response() -> json(['message' => 'faild'],400);
    }

    public function deleteBooking(Request $request){
        $book = DoctorScudule::where('id',$request->id)->first();
        if($book){
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
            $book1 =DoctorScudule::where('patient_id',$patient->id)
            ->where('id',$request->id)->count();
            if($book1){
                $book1 =DoctorScudule::where('patient_id',$patient->id)
            ->where('id',$request->id)->delete();
            return response()->json([
               'data' => $book1,
               'message' =>'success'
            ]);
        }}}
        return response()->json([
        'message' => 'faild'
        ],400);
    }
      public function getAppoiment(Request $request) {
        //return $request;
        $doctor = Appointment::where('phoneNumber', $request->phoneNumber)->first();
        //return $doctor;
        if($doctor){
        $patient = DoctorScudule::where('appoiment_id',$doctor->id)->count();
        if ($patient) {
            $patients = DoctorScudule::where('appoiment_id',$doctor->id)->with('patient')->get();
            return response() -> json([
                'data' => $patients,
                'message' => 'success'
            ]);
        }}
        return response() -> json(['message' => 'faild'],400);
    }
    public function isAccept(Request $request){
        $reqdata = $request -> all();
        $reqdata['is_accept'] = 1;
        $accept = DoctorScudule::where('id',$request->id)->count();
        if($accept){
       $accept = DoctorScudule::where('id',$request->id)->update($reqdata);
       return response()->json([
        'data' => $accept,
        'message' =>'success',
       ]);}
       return response() -> json(['message' => 'faild'],400);
   }
   public function deleteAppoinment(Request $request){
    $appointment = Appointment::where('address',$request->address)
    ->where('idCode',$request->idCode)->first();
    if($appointment){
        $appointment = Appointment::where('address',$request->address)
        ->where('idCode',$request->idCode)->delete();
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
        $doctor = OnlineDoctor::where('idCode',$request->id)->first();
        if($doctor){
            $rate = Rate::create([
             'doctorRate' => $request->doctorRate,
             'doctor_id' => $doctor->id,
             'patient_id' => $patient->id,
             'servicing' => $request->servicing,
             'cleanliness' =>$request->cleanliness,
             'nursing' => $request->nursing,
             'price' => $request->price,
             'receiption' =>$request->receiption,
            ]);
             $rates = Rate::where('doctor_id',$doctor->id)->avg('doctorRate');
            $doc = OnlineDoctor::where('idCode',$request->id)->update([
          'totalRating' => $rates,
        ]);
            return response()->json([
             'data' => $rate,
             'message' => 'success',
            ]);
        }
    }
    return response()->json([
    'message' => 'faild',
    ],400);
}

   public function getRate(Request $request){
    $doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
    if($doctor){
        $rate = Rate::where('doctor_id',$doctor->id)->count();
        if($rate){
            $rate = Rate::where('doctor_id',$doctor->id)->get();
            return response()->json([
              'data' => $rate,
              'message'=>'success',
            ]);
        }}
        return response()->json([
         'message'=>'faild',
        ],400);
   }
public function searchFamilyDoctorName(Request $request) {
    $homecare = OnlineDoctor::where('name', 'LIKE', '%'.$request->name.'%')->where('speciality','General') -> count();
    if ($homecare) {
        $homecare1 = OnlineDoctor::where('name', 'LIKE', '%'.$request->name.'%')->where('speciality','General') -> get();
        return response() -> json([
            'data' => $homecare1,
            'message' => 'success'
        ]);
    }
    return response() -> json(['message' => 'faild'],400);
 }
 public function allDoctorName(Request $request) {
    $homecare = OnlineDoctor::where('name', 'LIKE', $request->name.'%') -> count();
    if ($homecare) {
        $homecare1 = OnlineDoctor::where(
            'name',
            'LIKE',
            '%'.$request -> name.'%'
        ) -> get();
        return response() -> json([
            'data' => $homecare1,
            'message' => 'success'
        ]);
    }
    return response() -> json(['message' => 'faild'],400);
 }
public function requestFamilyDoctor(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    if($patient){
    $doctor = OnlineDoctor::where('idCode',$request->id)->first();
    if($doctor){
        $doctorFamily = familyDoctor::create([
           'idCodePatient' => $patient->id,
           'idCodeDoctor' => $doctor->id,
        ]);
        return response()->json([
          'data' => $doctorFamily,
          'message' => 'success',
        ]);
    }}
    return response()->json([
        'message' => 'faild',
    ],400);
 }
public function barnshDoctor(Request $request){
     $doctor = Hosptail::where('idCode',$request->idCode)->first();
     if($doctor){
         $request = Hosptail::create([
            'primary_speciality' => $request->primary_speciality,
            'name' => $request->name,
            'hospital_id' => $request->id,
         ]);
         return response()->json([
              'data' => $request,
              'message' => 'success',
         ]);
     }
     return response()->json([
        'message' => 'faild',
     ],400);
 }
public function acceptFamilyDoctor(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    if($patient){
    $doctor = OnlineDoctor::where('idCode',$request->id)->first();
        if($doctor){
            $request1 = familyDoctor::where('idCodePatient',$patient->id)->where('idCodeDoctor',$doctor->id)->first();
            if($request1){
                $request1 = familyDoctor::where('idCodePatient',$patient->id)->where('idCodeDoctor',$doctor->id)
                ->update([
                    'is_accept' => $request->is_accept,
                ]);
                return response()->json([
                    'data' => $request1,
                    'message' => 'success',
                ]);
        }
    }

    }
    return response()->json([
     'message' => 'faild'
    ],400);
}
public function requestFamilyDoctorGet(Request $request){
    $patien2 = OnlineDoctor::where('idCode',$request->idCode)->first();
        if($patien2){
        $request = familyDoctor::where('idCodeDoctor',$patien2->id)->where('is_accept',0)->count();
        if($request){
            $request = familyDoctor::where('idCodeDoctor',$patien2->id)->where('is_accept',0)->with('patient')->get();
            return response()->json([
                'data' => $request,
                'message' => 'success',
               ]);
        }}
    return response()->json([
      'message' => 'faild'
    ],400);
   }
public function deleteRequestFamilyDoctor(Request $request){
    $patient = Patien::where('idCode',$request->idCode)->first();
    if($patient){
    $patien2 = OnlineDoctor::where('idCode',$request->id)->first();
    if($patien2){
    $request = familyDoctor::where('idCodeDoctor',$patien2->id)->where('idCodePatient',$patient->id)
    ->where('is_accept',0)->count();
    if($request){
        $request = familyDoctor::where('idCodeDoctor',$patien2->id)->where('idCodePatient',$patient->id)
        ->where('is_accept',0)->delete();
        return response()->json([
            'data' => $request,
            'message' => 'success',
           ]);
    }
    }}
  return response()->json([
  'message' => 'faild'
  ],400);
  }
  public function requestPatientFamilyDoctorGet(Request $request){
    $patien2 = Patien::where('idCode',$request->idCode)->first();
        if($patien2){
        $request = familyDoctor::where('idCodePatient',$patien2->id)->where('is_accept',0)->first();
        if($request){
            $request = familyDoctor::where('idCodePatient',$patien2->id)->where('is_accept',0)->with('doctor')->get();
            return response()->json([
                'data' => $request,
                'message' => 'success',
               ]);
        }}

    return response()->json([
      'message' => 'faild'
    ],400);
   }
   public function getFamilyDoctor(Request $request){
    $patien2 = Patien::where('idCode',$request->idCode)->first();
   if($patien2){
   $request = familyDoctor::where('idCodePatient',$patien2->id)->where('is_accept',1)->count();
   if($request){
   $request = familyDoctor::where('idCodePatient',$patien2->id)->where('is_accept',1)->with('doctor')->get();
   return response()->json([
   'data' => $request,
   'message' => 'success',
   ]);
   }}
    return response()->json([
    'message' => 'faild'
    ],400);
   }
   public function getAllPatientRequest(Request $request){
    $patien2 = OnlineDoctor::where('idCode',$request->idCode)->first();
        if($patien2){
        $request = familyDoctor::where('idCodeDoctor',$patien2->id)->where('is_accept',1)->count();
        if($request){
            $request = familyDoctor::where('idCodeDoctor',$patien2->id)->where('is_accept',1)->with('patient')->get();
            return response()->json([
                'data' => $request,
                'message' => 'success',
               ]);
        }}

    return response()->json([
      'message' => 'faild'
    ],400);
   }


   public function doctorUpdatePatient(Request $request){
    $online_doctor = OnlineDoctor::findOrFail($request->id);
    $patient = Patien::findOrFail($request->patient_id);
    $patienData = patientData::where('patient_id',$request->patient_id)->first();
    $requestData = $request->all();
    $data2 = [
        'agree_name'            => $request->diseases,
        'surgery_data'          => $request->surgeries,
        'medication_name' => $request->medication,
        'patient_id'              =>$request->patient_id,
       ];
       $update = $patienData->update($data2);
       if($update){
           return response()->json([
            'data' => $update,
            'status' => true,
            'message' => 'patient profile updated successfuly',
           ],200);
       }

       return response()->json([
        'status' => false,
        'message' => 'faild',
       ],404);
   }
   
   public function getAllKids(Request $request){
    try{
        $kids = Child::where('patient_id',$request->patient_id)->get();
        if($kids->count() > 0){
            return response()->json([
                 'data' => $kids,
                 'message' => 'success',
                 'status' => true
            ]);
        }
        return response()->json([
            'message' => 'kids not found',
            'status' => false
        ],400);

    }catch (\Exception $ex){
        return response()->json([
           'message' => $ex->getMessage(),
           'status' => false
        ],500);
    }
   }
   
     public function doctorEditProfile(Request $request){
    try{
        $doctor = OnlineDoctor::where('idCode',$request->idCode)->first();
        if($doctor){
            $requestData = $request->all();
            if($request->phoneNumber[0] == '0'){
                $requestData['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $requestData['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            $doctor->phoneNumber = $requestData['phoneNumber'];
            $doctor->idCode = str_replace('+','D',$requestData['phoneNumber']);
            $doctor->image = $request->image;
            $doctor->email = $request->email;
            $doctor->license_number = $request->license_number;
            $doctor->address = $request->address;
            $doctor->speciality_id = $request->speciality_id;
            $doctor->save();
            return response()->json([
               'message' => 'updated successfuly',
               'status' => true
            ]);
        }
        return response()->json([
           'message' => 'Doctor not found',
           'status' => false
        ],400);
    }catch (\Exception $ex){
        return response()->json([
           'message' => $ex->getMessage(),
           'status' => false
        ],500);
    }
   }

}
