<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Requests\backEnd\stogreAnalzes;
use App\Http\Requests\backEnd\stogreRay;
use App\models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\addAppoiemntDoctor;
use App\Http\Requests\backEnd\child\StoreResultRay;
use App\Http\Requests\backEnd\child\StoreResultTest;
use App\models\Clinic;
use App\models\Patien;
use App\models\API\Rays;
use App\models\API\analyzes;
use App\models\patient_rays;
use App\models\patient_analzes;
use App\models\Doctor;
use App\models\Raoucheh;
use App\Http\Requests\backEnd\doctor\StoreDoctor;
use App\Http\Requests\backEnd\clinic\Store;
use App\Http\Requests\backEnd\clinic\Update;
use App\Http\Requests\backEnd\clinic\StoreAnalaz;
use App\Http\Requests\backEnd\clinic\StoreRays;
use App\Http\Requests\backEnd\clinic\StoreRaoucata ;
use App\Http\Requests\backEnd\hosptail\StorePatien;
use App\Http\Requests\backEnd\clinic\updateDepartement;
use App\Http\Requests\backEnd\clinicAppointmentsDoctor;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\verifyClinic;
use Illuminate\Support\Facades\Validator;
use App\models\Branch;
use App\models\Day;
use App\models\hospitalAppointment;
use App\models\OnlineDoctor;
use RealRashid\SweetAlert\Facades\Alert;

class clinicController extends Controller
{
    public function register(Request $request){
        $clinic = $request->session()->get('clinic');
        return view('backEnd.clinic.register',compact('clinic'));
    }
    public function postRegister1(Request $request){
        //return "Alo";
        // try{
            $request_data = $request->all();
        /* upload img */
        if($request->image){
            $img = Image::make($request->image)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $request->image->hashName()));
            $request_data['image'] = asset('uploads/' . $request->image->hashName());
        }
        /* upload Clinic_License */
        if($request->Clinic_License){
            $img = Image::make($request->Clinic_License)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $request->Clinic_License->hashName()));
            $request_data['Clinic_License'] = asset('uploads/' . $request->Clinic_License->hashName());
        }
        /* secure password */
        $request_data['password'] = bcrypt($request->password);
        $request_data['password_confirmation'] = bcrypt($request->password_confirmation);
        // role = patient //
        $request_data['role'] = 'clinic';
        if($request->phoneNumber[0] == '0'){
            $request_data['phoneNumber'] =  $request->countryCode . substr($request->phoneNumber,1);
        }else{
             $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
        }
        $request_data['idCode'] = $request_data['phoneNumber'];
        /* insert data */
        if(empty($request->session()->get('clinic'))){
            $clinic = new Clinic();
            $clinic->fill($request_data);
            $request->session()->put('clinic', $clinic);
        }else{
            $clinic = $request->session()->get('clinic');
            $clinic->fill($request_data);
            $request->session()->put('clinic', $clinic);
        }
        // $clinic_create = Clinic::create($request_data);
        $clinicPhone = Clinic::where('phoneNumber',$request_data['phoneNumber'])->first();
        if(!$clinicPhone){
            return redirect()->route('clinic_verify');
        }
        return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);

        // return redirct //
        // }
        // catch(\Exception $e){
        //     return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        // }

    }
    /* function send email */
    public  function welcome($id){
        try{
            $clinic = Clinic::findOrFail($id);
            return view('backEnd.clinic.welcomePage',compact('clinic'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['problem']);
        }

    }
    public function sendEmail($id){
        $clinic = Clinic::findOrFail($id);
        Mail::to($clinic->email)->send(new verifyClinic($clinic));
        return redirect()->back()->with(['EmailMsg'=>'Check Your Email']);
    }
    /* end of function send email */
    /* function verify clinic */
    public function verifyClinic($id){
        $clinic = Clinic::findOrFail($id);
        $clinic->verify = 1;
        $clinic->save();
        auth()->guard('clinic')->login($clinic);
        return redirect()->route('clinic.edit.profile',$clinic->id);
    }
    /* end of function */
    /* function profile */
    public function profile($id){
        try{
            $clinic = Clinic::find($id);
            return view('backEnd.clinic.profile',compact('clinic'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error'=> 'problem']);
        }

    }
    /* end of function profile */
    public function clinic_get_patien_profile($id,$patien_id){
        try{
            $clinic = Clinic::findOrFail($id);
        $patien = Patien::findOrFail($patien_id);
        return view('backEnd.clinic.clinic_patien_profile',compact('clinic','patien'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* function edit profile */
    public function editProfile($id){
        try{
            $clinic = Clinic::findOrFail($id);
        return view('backEnd.clinic.edit',compact('clinic'));
        }

        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* function edit profile */
    /* function update profile */
    /* edit profile */
    public function updateProfile($id, Update $request){
        try{
            $clinic = Clinic::findOrFail($id);
            $request_data = $request->all();
            if($request->oldPhoneNumber != $request->countryCode . $request->phoneNumber){
                if($request->phoneNumber[0] == '0'){
                    $requestData['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
                }else{
                    $requestData['phoneNumber'] = $request->countryCode . $request->phoneNumber;
                }
                if($request->image){
                    $img = Image::make($request->image)
                    ->resize(1280,400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/' . $request->image->hashName()));
                    $requestData['image'] = asset('uploads/' . $request->image->hashName());
                }
                // $patient->update($requestData);
                $setSession = $request->session()->put('updatePhoneNumber',$requestData['phoneNumber']);
                $setSessionadd = $request->session()->put('updateaddress',$requestData['address']);
                $setSessionlat = $request->session()->put('updatelatitude',$requestData['latitude']);
                $setSessionlong = $request->session()->put('updatelongitude',$requestData['longitude']);
                $requestData['Medical_License_Number'] = $request->Medical_License_Number;
                return redirect()->route('editClinicVerify',$clinic->id);
                // dd(session()->get('updatePhoneNumber'));
            }
        /* update image */
            if($request->image){
                $img = Image::make($request->image)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/clinic/' . $request->image->hashName()));
                $request_data['image'] = $request->image->hashName();
            }
            if($request->Clinic_License){
                $img = Image::make($request->Clinic_License)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/clinic/' . $request->Clinic_License->hashName()));
                $request_data['Clinic_License'] = $request->Clinic_License->hashName();
            }
            if($request->phoneNumber[0] == '0'){
                $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                 $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            /* update image */
            $request_data['address'] = $request->address;
            $request_data['latitude'] = $request->latitude;
            $request_data['longitude'] = $request->longitude;
            $request_data['Medical_License_Number'] = $request->Medical_License_Number;
            $clinic->update($request_data);
            alert()->html("<img width=150 src='https://phistory.life/Phistory/public/imgs/alert/Don1e.png'>",false);
            return redirect()->route('clinic.homepage',$clinic->id);
            }

        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
        return dd($request_data = $request->all());

    }
    /* function update profile */
    /* function logout */
    public function logout(){
        Auth::guard('clinic')->logout();
        return redirect()->route('indexRoute');
    }

    /* end of function */
    /* function search patient form phone number */
    public function search($id,$doctor_id,Request $request){
        $clinic = Clinic::findOrFail($id);
        $doctor = Doctor::findOrFail($doctor_id);
        $rays = Rays::get();
        $analyzes = analyzes::get();
        $patient = Patien::with(['patient_analzes','patient_rays','Raoucheh'])->where('IdCode','like','%' . $request->search . '%')->first();
        if($patient){
            return view('backEnd.clinic.search-patient',compact('patient','clinic','rays','analyzes','doctor'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }
    /* function search patient form phone number */
    /* function store raoucata */
    public function storeRaoucata(StoreRaoucata $request){

        // return $request;


        $clinic = Clinic::findOrFail($request->clinic_id);
        $request_data = $request->all();
        if(isset($request_data['medication']) && count($request_data['medication']) > 0){
            foreach($request_data['medication'] as $item => $v){
                $roaucata_data = [
                    'prescription'  => $request->prescription,
                    'weight'        => $request->weight,
                    'temperature'   => $request->temperature,
                    'blood_pressure'=> $request->blood_pressure,
                    'diabetics'     => $request->diabetics,
                    'jaw_type'      => $request->jaw_type,
                    'jaw_direction' => $request->jaw_direction,
                    'teeth_type'    => $request->teeth_type,
                    'eye_type'      => $request->eye_type,
                    'medication'=> json_encode($request->medication),
                    'patient_id'    => $request->patient_id,
                    'doctor_id'     => $request->doctor_id,
                ];
            }
        }
        $roaucataCreate = Raoucheh::create($roaucata_data);


        if(isset($request_data['testName']) && count($request_data['testName']) > 0){
            foreach($request_data['testName'] as $item => $v){
                $test_data = [
                    'test_name'=> json_encode($request->testName),

                    'patient_id'    => $request->patient_id,
                    'doctor_id'     => $request->doctor_id,
                    'rocata_id'     => $roaucataCreate->id
                ];
            }
        }
        $testCreate = patient_analzes::create($test_data);
        if(isset($request_data['rayName']) && count($request_data['rayName']) > 0){
            foreach($request_data['rayName'] as $item => $v){
                $ray_data = [
                    'ray_name'  => json_encode($request->rayName),

                    'patient_id'    => $request->patient_id,
                    'doctor_id'     => $request->doctor_id,
                    'rocata_id'     => $roaucataCreate->id
                ];
            }
        }
        $ray_create = patient_rays::create($ray_data);
        return redirect()->back();


    }

    /* end of function */
    public function patient_clinic_add_analzes(StoreAnalaz $request){
        // dd($request->all());
        $request_data = $request->all();
        $clinic = Clinic::findOrFail($request->clinic_id);

        $request_data['patient_id'] = $request->patient_id;
        $request_data['doctor_id'] = auth('doctor')->user()->id;

        $request_create = patient_analzes::create($request_data);
        if($request_create){
            return response()->json([
                'status'    => true,
                'msg'       => 'analazes created successfuly'
            ]);
        }
    }

    public function patient_clinic_add_rays(StoreRays $request){
        // dd($request->all());
        $request_data = $request->all();
        $clinic = Clinic::findOrFail($request->clinic_id);
        $request_data['patient_id'] = $request->patient_id;
        $request_data['doctor_id'] = auth('doctor')->user()->id;
        $request_create = patient_rays::create($request_data);
        if($request_create){
            return response()->json([
                'status'    => true,
                'msg'       => 'rays created successfuly'
            ]);
        }

    }

    public function as_a_doctor($id){
        $clinic = Clinic::findOrFail($id);
        return view('backEnd.clinic.as_a_doctor',compact('clinic'));
    }
    public function get_search_lab($id){
        $clinic = Clinic::findOrFail($id);
        return view('backEnd.clinic.clinic_lab_profile',compact('clinic'));
    }
    public function post_search_lab($id,Request $request){
        $clinic = Clinic::findOrFail($id);
        $patient = Patien::with(['patient_analzes'])->where('IdCode','like','%' . $request->search . '%')->first();
        if($patient){
            return view('backEnd.clinic.search_lab_clinic',compact('patient','clinic'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }

    public function get_search_xray($id){
        $clinic = Clinic::findOrFail($id);
        return view('backEnd.clinic.clinic_xray_profile',compact('clinic'));
    }
    public function post_search_xray($id,Request $request){
        $clinic = Clinic::findOrFail($id);
        $patient = Patien::with(['patient_rays'])->where('IdCode','like','%' . $request->search . '%')->first();
        if($patient){
            return view('backEnd.clinic.search_xray_clinic',compact('patient','clinic'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }

    public function get_search_pharmacy($id){
        $clinic = Clinic::findOrFail($id);
        return view('backEnd.clinic.clinic_pharmacy_profile',compact('clinic'));
    }
    public function post_search_pharmacy($id,Request $request){
        $clinic = Clinic::findOrFail($id);
        $patient = Patien::with(['Raoucheh'])->where('IdCode','like','%' . $request->search . '%')->first();
        if($patient){
            return view('backEnd.clinic.search_pharmacy_clinic',compact('patient','clinic'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }

    public function clinic_add_doctor($id,StoreDoctor $request){
//        dd($request->all());
        $doctor_data = $request->all();
        /* upload img */
        // doctor image
        if($request->image){
            $img = Image::make($request->image)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctor/clinic/' . $request->image->hashName()));
            $doctor_data['image'] = $request->image->hashName();
        }
        // national id front image
        if($request->national_id_front_side){
            $national_id_front = Image::make($request->national_id_front_side)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctor/clinic/' . $request->image->hashName()));
            $doctor_data['national_id_front_side'] = $request->national_id_front_side->hashName();
        }
        // national id back image
        if($request->national_id_back_side){
            $national_id_back_side = Image::make($request->national_id_back_side)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctor/clinic/' . $request->national_id_back_side->hashName()));
            $doctor_data['national_id_back_side'] = $request->national_id_back_side->hashName();
        }
        $doctor_data['password'] = bcrypt($request->password);
        $doctor_data['clinic_id'] = $request->clinic_id;
        if($request->phoneNumber[0] == '0'){
            $doctor_data['phoneNumber'] = substr($request->phoneNumber,1);
        }else{
             $doctor_data['phoneNumber'] =  $request->phoneNumber;
        }
        $doctor_data['IdCode'] = $request->countryCode  . $doctor_data['phoneNumber'];
        $clinic = Clinic::findOrFail($id);
        $doctor_create = Doctor::create($doctor_data);
        // auth('doctor')->login($doctor_create);
        return redirect()->route('doctor_verify',[$doctor_create['id'],$doctor_create['clinic_id']]);
    }
    /* clinic add test access [xray] */
    public  function clinic_add_Result_rays(stogreRay $request){
        $ray_data = $request->all();
        foreach ($request->ray_id as $ray){
            if($request->file('result_name')){
                $file = $request->file('result_name');
                $file_name = rand(100000,999999).$file->getClientOriginalName();
                $file->move('uploads/pdf_file/result/rays/' , $file_name);
                $ray_data['result_name'] = $file;
            };
            Result::create([
                'name' => $ray_data['result_name'],
                'ray_id' => $ray,
                'patien_id'    => $ray_data['patient_id'],
            ]);
        }
        return redirect()->back()->with(['success_msg'=> 'ray uploded successfuly']);
    }
    public function clinic_addResult_analzes(stogreAnalzes $request){
        $test_data = $request->all();
        foreach ($request->test_id as $test){
            if($request->file('result_name')){
                $file = $request->file('result_name');
                $file_name = rand(100000,999999).$file->getClientOriginalName();
                $file->move('uploads/pdf_file/result/analzes/' , $file_name);
                $test_data['result_name'] = $file_name;
            };
            Result::create([
                'name' => $test_data['result_name'],
                'test_id' => $test,
                'patien_id'    => $test_data['patient_id'],
            ]);
        }
        return redirect()->back()->with(['success_msg'=> 'test uploded successfuly']);
    }

    public  function clinic_child_add_Result_rays(StoreResultRay $request){
        $ray_data = $request->all();
        foreach ($request->ray_child_id as $ray){
            if($request->file('result_name')){
                $file = $request->file('result_name');
                $file_name = rand(100000,999999).$file->getClientOriginalName();
                $file->move('uploads/pdf_file/result/rays/child/' , $file_name);
                $ray_data['result_name'] = $file_name;
            };
            Result::create([
                'name' => $ray_data['result_name'],
                'ray_child_id' => $ray,
                'child_id'    => $ray_data['child_id'],
            ]);
        }
        return redirect()->back()->with(['success_msg'=> 'ray uploded successfuly']);
    }
    public function clinic_child_addResult_analzes(StoreResultTest $request){
        $test_data = $request->all();
        foreach ($request->test_child_id as $test){
            if($request->file('result_name')){
                $file = $request->file('result_name');
                $file_name = rand(100000,999999).$file->getClientOriginalName();
                $file->move('uploads/pdf_file/result/analzes/child/' , $file_name);
                $test_data['result_name'] = $file_name;
            };
            Result::create([
                'name' => $test_data['result_name'],
                'test_child_id' => $test,
                'child_id'    => $test_data['child_id'],
            ]);
        }
        return redirect()->back()->with(['success_msg'=> 'test uploded successfuly']);
    }
    /* clinic add test access [xray] */
    public function loginDoctor($id){
        //return "Alo";
        $clinic = Clinic::with('doctors')->findOrFail($id);
        return view('backEnd.clinic.doctor.login',compact('clinic'));
    }
    public  function postDoctor($id,Request$request){
        $clinic = Clinic::findOrFail($id);
        $arr = [
            'IdCode' => 'required',
            'password'  => 'required',
        ];
        $vaild = Validator::make($request->all(),$arr);
        if($vaild->fails()){
            return redirect()->back();
        }
        $attmp = $request->only('IdCode','password');
        if(! Auth::guard('doctor')->attempt($attmp)){
            return redirect()->back()->with('msg','id code or password incorrect');
        }
        return redirect()->route('clinic.profile',$clinic->id);
    }
    /* clinic add patient function */
    public function clinic_add_patien(StorePatien $request){

        try{
            $request_data = $request->all();
        // dd($request->all());
        /* upload img */
        if($request->image){
            $img = Image::make($request->image)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/patien/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }
        /* secure password */
        $request_data['password'] = bcrypt($request->password);
        if($request->phoneNumber[0] == '0'){
            $request_data['phoneNumber'] = substr($request->phoneNumber,1);
        }else{
            $request_data['phoneNumber'] = $request->phoneNumber;
        }
        $request_data['idCode'] = str_replace('+','P',$request_data['countryCode']) . $request_data['phoneNumber'];

        // role = patient //
        $request_data['role'] = 'patient';
        $request_data['is_active'] = true;
        $request_data['clinic_id'] = $request->clinic_id;
        // dd($request->all());
        // dd($request_data['code']);
        /* insert data */
        $patienData = Patien::create($request_data);
        // return redirect()->route();
        return redirect()->back();
        }

        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    /* clinic branch page */
    public function clinic_branch($id){
        $clinic = Clinic::findOrFail($id);
        return view('backEnd.clinic.clinic_branch',compact('clinic'));
    }
    /* clinic branch page */


    public function clinic_login_branch(Request $request ,$id){
        $clinic = Clinic::findOrFail($id);
        $arr = [
            'name' => 'required',
            'password'  => 'required',
        ];
        $vaild = Validator::make($request->all(),$arr);
        if($vaild->fails()){
            return redirect()->back();
        }
        $attmp = $request->only('name','password');
        if(! Auth::guard('branch')->attempt($attmp)){
            return redirect()->back()->with('msg','Name code or password incorrect');
        }
        return redirect()->route('clinic_getAsBranch',[$clinic->id,auth()->guard('branch')->user()->id]);
    }

        public function clinic_getAsBranch($id,$branch_id){
            $clinic = Clinic::findOrFail($id);
            $branch = Branch::findOrFail($branch_id);
            return view('backEnd.branch.clinic_getAsBranch',compact('branch','clinic'));
        }
        public function clinic_add_dapartement(updateDepartement $request ,$id){
            $deparRequest = $request->all();
            $clinic = Clinic::findOrFail($id);
            $depar_update = $clinic->update($deparRequest);
            return redirect()->route('clinic_login_doctor',$id);
        }

        public function clinic_getAllPrescription($id,$patient_id){
            try{
                $clinic = Clinic::findOrFail($id);
                $patient = Patien::with('Raoucheh','patient_analzes','patient_rays')->findOrFail($id);
                return view('backEnd.clinic.clinic_all_prescrption',compact('patient','clinic'));
            }
            catch(\Exception $ex){
                return redirect()->back()->with(['error' => 'problem']);
            }
        }

        public function clinic_old_prescription($id,$patien_id){
            try{
                $clinic = Clinic::findOrFail($id);
                $patient = Patien::with('Raoucheh','patient_analzes','patient_rays')->findOrFail($patien_id);
                return view('backEnd.clinic.clinic_old_prescrption',compact('patient','clinic'));
            }
            catch(\Exception $ex){
                return redirect()->back()->with(['error' => 'problem']);
            }

        }

        public function welocmeDoctor($id,$clinic_id){
            $doctor = Doctor::findOrFail($id);
            $clinic = Clinic::findOrFail($clinic_id);
            return view('backEnd.clinic.welcomeDoctor',compact('doctor','clinic'));
        }
        public function clinic_branch_welcome_doctor($id,$clinic_id,$branch_id){
            $doctor = Doctor::findOrFail($id);
            $clinic = Clinic::findOrFail($clinic_id);
            $branch = Branch::findOrFail($branch_id);
            return view('backEnd.clinic.clinic_branch_welcome_doctor',compact('doctor','clinic','branch'));
        }
        // function homepage
        public function homepage($id){
            try{
                $clinic = Clinic::findOrFail($id);
                return view('backEnd.clinic.homepage',compact('clinic'));
            }
            catch(\Exception $ex){
                return redirect()->back()->with(['error' => 'back']);
            }
        }
        // function homepage

        public function clinicFindDoctor($id,Request $request){
            //return $request ;
            try{
                $clinic = Clinic::findOrFail($id);
                $doctors = OnlineDoctor::where('name','like','%'.$request->doctorName.'%')
                ->orwhere('speciality','like','%'.$request->doctorName.'%')
                ->count();

                if(!$doctors){
                    Alert::error('Error Message','Doctor Not Found');
                    return redirect()->back();
                }
                $doctors = OnlineDoctor::where('name','like','%'.$request->doctorName.'%')
                ->orwhere('speciality','like','%'.$request->doctorName.'%')
                ->get();
                //return $doctors;
                //$doctors = OnlineDoctor::all();
                $doc  = HospitalAppointment::where('clinic_id',$id)->first();

                return view('backEnd.clinic.doctor.showResultDoctor',compact('clinic','doctors','doc'));

            }catch(\Exception $ex){
                //return $ex->getMessage() ;
                return redirect()->back()->with(['error' => 'Serve Problem']);

            }

        }
        //clinicAppointmentsDoctor
        public function appointmentsDoctor(Request $request){
            //return $request;
            try{

                $this->validate($request, [
                    'doctor_id'     => 'integer|required|exists:online_doctors,id',
                    'doctor_name'   => 'required|string',
                    //'doctor_address'    => 'required',
                    'doctor_idCode'     => 'required|exists:online_doctors,idCode',
                    'doctor_phoneNumber'=> 'required|exists:online_doctors,phoneNumber',
                    'doctor_special'    => 'required|string|exists:doctor_specailties,name',
                    //'doctor_lat'        => 'required',
                    //'doctor_lan'        => 'required',
                    'doctor_image'      => 'required',
                    'clinic_id'         =>'required|exists:clinics,id'
                ]);

                //Alert::success('success Message','Doctor Added Successfuly');
                $appoientHosptailDoctor = hospitalAppointment::create([
                    'doctor_name'   => $request->doctor_name,
                    'address'       => $request->doctor_address,
                    'special'       => $request->doctor_special,
                    'idCode'        => $request->doctor_idCode,
                    'phoneNumber'   => $request->doctor_phoneNumber,
                    'image'         => $request->doctor_image,
                    'latitude'      => $request->doctor_lat,
                    'longitude'     => $request->doctor_lan,
                    'doctor_id'     => $request->doctor_id,
                    'clinic_id'   => $request->clinic_id
                ]);
                //return $appoientHosptailDoctor;
                return redirect()->back()->with(['success' => 'Doctor Added Successfuly']);
            }catch(\Exception $ex){
                //return "Alo";
                //return $ex->getMessage() ;
                return redirect()->back()->with(['error' => 'Not Enough Data']);
            }
        }

        public function clinicdoctorAppoiement($id){
            try{
                $days = Day::get();
                $clinic = Clinic::findOrFail($id);
                $doctorAppoiment = hospitalAppointment::where('clinic_id',$clinic->id)->get(['doctor_name','address','idCode','image','special','phoneNumber','doctor_id','appointments']);
                return view('backEnd.clinic.doctor.doctorAppoiement',compact('clinic','doctorAppoiment','days'));
            }catch(\Exception $ex){
                return redirect()->back()->with(['error' => 'Problem']);
            }

        }

        public function bookDocApp($id,addAppoiemntDoctor $request){
            try{
                Alert::success('Success','Booked Success');
                $clinic = Clinic::findOrfail($id);
                $doctor_id = hospitalAppointment::where('doctor_id',$request->doctor_id)
                ->where('clinic_id',$clinic->id)
                ->first();
                if($doctor_id){
                    $app = $request->appointments;
                    foreach($app as $key=>$val){
                        $app[$key]['time'] = $app[$key]['time'] . ', ' . $request->from . ' To ' . $request->to;
                    }
                    $doctor_id->appointments = $app;
                    $doctor_id->fees = $request->fees;
                    $doctor_id->save();
                    return redirect()->back()->with(['success' => 'updated successfuly']);
            }
            }catch(\Exception $ex){
                return redirect()->back()->with(['error' => 'Problem']);
            }
        }
}

