<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backEnd\patien\Store;
use App\models\Pharmacy;
use App\models\Patien;
use App\models\Qrpharmacy;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class pharmacyController extends Controller
{
    public function register(Request $request) {
        $pharmacyRequest = $request -> all();
        $validator = Validator::make($pharmacyRequest, [
            'image' => '',
            'pharmacyName' => '',
            'Medical_License_Number' => '',
            'pharmacy_License' => '',
            'idCode' => 'required|unique:pharmacies',
            'telephone' => '',
            'Hotline' => '',
            'email' => 'email|unique:pharmacies',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|sometimes|required_with:password',
            'address' => '',
            'latitude' => '',
            'longitude' => ''
        ]);
        if ($validator -> fails()) {
            return response([
                'error' => $validator -> errors(),
                'Validation Error'
            ],400);
        }
        $pharmacyRequest['password'] = bcrypt($request -> password);
        $pharmacyRequest['password_confirmation'] = bcrypt(
            $request -> password_confirmation
        );
        $pharmacyRequest['phoneNumber'] = str_replace(
            'Y',
            '+',
            $pharmacyRequest['idCode']
        );
        $pharmacyRequest['role'] = 'pharmacy';
        $pharmacyRequest['is_active'] = true;
        $pharmacyCreate = Pharmacy::create($pharmacyRequest);
        $success['token'] = $pharmacyCreate -> createToken('MyApp') -> accessToken;
        if ($pharmacyCreate) {
            return response() -> json([
                'data' => $pharmacyCreate,
                'message' => 'success',
                'token' => $success['token']
            ]);
        }
    }
    public function pharmacyGetAll() {
        $pharmacies = Pharmacy::count();
        if ($pharmacies) {
            $pharmacies = Pharmacy::paginate(20);
            return response([
                'data' => $pharmacies,
                'message' => 'success'
            ], 200);
        } else {
            return response(['message' => 'failed'],400);
        }
    }
    public function login() {
        if (Auth::guard('pharmacy') -> attempt([
            'idCode' => request('idCode'),
            'password' => request('password')
        ])) {
            $user = Auth::guard('pharmacy') -> user();
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
        $patient = Pharmacy::where('idCode', $request -> idCode) -> first();
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
    public function searchPharmacy(Request $request) {
        $hospital = Pharmacy::where('idCode', $request -> idCode) -> count();
        if ($hospital) {
            $hospital = Pharmacy::where('idCode', $request -> idCode) -> get();
            return response() -> json([
                'data' => $hospital,
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
            return response(['message' => 'failed']);
        }

    }
    private function getNearby($request) {
        $latitudeTo = $request -> latitude;
        $longitudeTo = $request -> longitude;
        $earthRadius = 6378137;
        $nearbyPharmacies =  [];
        $pharmacies = Pharmacy::where('pharmacyName', 'LIKE', $request -> name.'%') -> paginate(
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
            $distance = $distance >= 1000
                ? (round($distance / 1000, 2))
                : $distance;
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
    public function QrPharmacy(Request $request) {
        $patient = Patien::where('idCode',$request->idCode)->first();
        if($patient){
        $qr = Qrpharmacy::where('idPatient',$request ->idCode)->first();
        if(!$qr){
        $qr = Qrpharmacy::create([
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
    public function QrPharmacyGet(Request $request) {
        $qr = Qrpharmacy::where([
            'idEnterprise' => $request -> id
        ]) -> count();
        if ($qr) {
            $qr = Qrpharmacy::where([
                'idEnterprise' => $request -> id
            ]) -> get();
            return response() -> json([
                'data' => $qr,
                'message' => 'success'
            ]);
        }
        return response() -> json(['message' => 'failed'],400);
    }

    public function pharmacy_add_patien(Store $request,$id){
        try{
            $pharmacy = Pharmacy::findOrFail($id);
            $request_data = $request->all();
            if($request->image){
                $image = $request->file('image');
                $input =  $request_data['image'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $img = Image::make($image->getRealPath());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$request_data['image']);

                // $destinationPath = public_path('/images');
                $image->move($destinationPath, $request_data['image']);
                $request_data['image'] = asset('uploads/' . $input);
                // $this->image->add($);
                // return $request_data['image'];
            }
            /* secure password */
            $request_data['password'] = bcrypt($request->password);
            if($request->phoneNumber[0] == '0'){
                $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            $request_data['password_confirmation'] = bcrypt($request->password_confirmation);
            $request_data['name'] = $request->firstName .' ' . $request->lastName;
            $request_data['idCode'] = str_replace('+','P',$request_data['phoneNumber']);
            $request_data['BirthDate'] = (new Carbon($request->BirthDate))->timestamp;
            // role = patient //
            $request_data['role'] = 'patient';
            $request_data['is_active'] = false;
            //  return $request_data;
            /* insert data in session */
            $patientPhone = Patien::where('phoneNumber',$request_data['phoneNumber'])->first();
            if(!$patientPhone){
                $patientCreate = Patien::create($request_data);
                // dd($patientCreate);
                $pharmacy->poients = $pharmacy->poients + 5;
                $pharmacy->save();
                return redirect()->back()->with(['success' => 'patient Added Successfuly']);
            }
            return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);
        }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !'],400);
        }
    }
}
