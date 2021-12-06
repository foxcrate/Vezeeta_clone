<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Requests\backEnd\stogreAnalzes;
use App\Http\Requests\backEnd\stogreRay;
use App\Http\Requests\backEnd\child\StoreResultRay;
use App\Http\Requests\backEnd\child\StoreResultTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\addAppoiemntDoctor;
use App\models\Hosptail;
use App\models\Patien;
use App\models\patient_analzes;
use App\models\Doctor;
use App\models\patient_rays;
use App\models\Result;
use App\models\hospitalAppointment;
use App\models\Raoucheh;
use App\models\API\analyzes;
use App\models\API\Rays;
use App\Http\Requests\backEnd\hosptail\Store;
use App\Http\Requests\backEnd\doctor\StoreDoctor;
use App\Http\Requests\backEnd\hosptail\Update;
use App\Http\Requests\backEnd\hosptail\StoreAnalaz;
use App\Http\Requests\backEnd\hosptail\StorePatien;
use App\Http\Requests\backEnd\hosptail\StoreRays;
use App\Http\Requests\backEnd\hosptail\StoreRaoucata;
use App\Http\Requests\backEnd\hosptail\updateDepartement;
use App\Http\Requests\backEnd\hosptailAppointmentsDoctor;
use Illuminate\Support\Facades\Mail;
use App\Mail\verifyHosptail;
use App\models\Branch;
use App\models\Day;
use App\models\OnlineDoctor;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class hosptailController extends Controller
{
    public function register(Request $request){
        try{
            $hosptail = $request->session()->get('hosptail');
            return view('backEnd.hosptail.register',compact('hosptail'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function postRegister(Store $request){
        try{
            $request_data = $request->all();
        /* upload img */
        if($request->image){
            $img = Image::make($request->image)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $request->image->hashName()));
            $request_data['image'] = asset('uploads/' . $request->image->hashName());
        }
        /* upload hosptail */
        if($request->Hosptail_License){
            $img = Image::make($request->Hosptail_License)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $request->Hosptail_License->hashName()));
            $request_data['Hosptail_License'] = asset('uploads/' . $request->Hosptail_License->hashName());
        }
        /* secure password */
        $request_data['password'] = bcrypt($request->password);
        if($request->phoneNumber[0] == '0'){
            $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
        }else{
             $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
        }
        $request_data['password_confirmation'] = bcrypt($request->password_confirmation);
        $request_data['idCode'] = $request_data['phoneNumber'];
        // role = patient //
        $request_data['role'] = 'hosptail';

        // $request_data['is_active'] = false;
        /* insert data */
        // $hosptail_create = Hosptail::create($request_data);

        if(empty($request->session()->get('hosptail'))){
            $hosptail = new Hosptail();
            $hosptail->fill($request_data);
            $request->session()->put('hosptail', $hosptail);
        }else{
            $hosptail = $request->session()->get('hosptail');
            $hosptail->fill($request_data);
            $request->session()->put('hosptail', $hosptail);
        }
        $hosptailPhone = Hosptail::where('phoneNumber',$request_data['phoneNumber'])->first();
        if(!$hosptailPhone){
            return redirect()->route('hosptail_verify');
        }
        return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);
    }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        }
    }

    public  function welcome($id){
        $hosptail = Hosptail::findOrFail($id);
        return view('backEnd.hosptail.welcomePage',compact('hosptail'));
    }
    /* function verify hosptail */
    public function verifyHosptail($id){
        $hosptail = Hosptail::findOrFail($id);
        $hosptail->verify = 1;
        $hosptail->save();
        auth()->guard('hosptail')->login($hosptail);
        return redirect()->route('hosptail.edit.profile',$hosptail->id);
    }
    /* edit profile */
    public function editProfile($id){
        $hosptail = Hosptail::findOrFail($id);
        return view('backEnd.hosptail.edit',compact('hosptail'));
    }
    /* edit profile */
    public function updateProfile($id, Update $request){
        try{
            $hosptail = Hosptail::findOrFail($id);
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
                return redirect()->route('editHosptailVerify',$hosptail->id);
                // dd(session()->get('updatePhoneNumber'));
            }
            /* update image */
            if($request->image){
                $img = Image::make($request->image)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/hosptail/' . $request->image->hashName()));
                $request_data['image'] = $request->image->hashName();
            }
            // hosptail license
            if($request->Hosptail_License){
                $img = Image::make($request->Hosptail_License)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/hosptail/' . $request->Hosptail_License->hashName()));
                $request_data['Hosptail_License'] = $request->Hosptail_License->hashName();
            }
            /* update image */
            if($request->phoneNumber[0] == '0'){
                $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            $request_data['address'] = $request->address;
            $request_data['latitude'] = $request->latitude;
            $request_data['longitude'] = $request->longitude;
            $request_data['Medical_License_Number'] = $request->Medical_License_Number;
            $hosptail->update($request_data);
            alert()->html("<img width=150 src='https://phistory.life/Phistory/public/imgs/alert/Don1e.png'>",false);
            return redirect()->route('hosptail.homepage',$hosptail->id);
        }
        catch(\Exception $ex){
            return redirect()->back();
        }
        // return dd($request_data = $request->all());

    }
    // profile function
    public function profile($id){
        $hosptail = Hosptail::find($id);
        return view('backEnd.hosptail.profile',compact('hosptail'));
    }
    // hosptail_get_patient_profile
    public function hosptail_get_patien_profile($id,$patien_id){
        $hosptail = Hosptail::find($id);
        $patien = Patien::find($patien_id);
        return view('backEnd.hosptail.hosptail_patien_profile',compact('hosptail','patien'));
    }
    /* function search patient form phone number */
    public function search($id,$doctor_id,Request $request){
        $hosptail = Hosptail::findOrFail($id);
        $doctor = Doctor::findOrFail($doctor_id);
        $analyzes = analyzes::get();
        $rays = Rays::get();
        $patient = Patien::with(['patient_analzes','patient_rays','Raoucheh'])->where('IdCode','like','%' . $request->search . '%')->first();
        if($patient){
            return view('backEnd.hosptail.search-patient',compact('patient','hosptail','analyzes','rays','doctor'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }
    /* function search patient form phone number */
    /* end of function */
    /* function logout */
    public function logout(){
        Auth::guard('hosptail')->logout();
        return redirect()->route('indexRoute');
    }
    /* end of function */
    /* function store raoucata */
    public function storeRaoucata(StoreRaoucata $request){
        //dd($request->all());
        $hosptail = Hosptail::findOrFail($request->hosptail_id);
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

    // as a docotor function
    public function as_a_doctor($id){
        try{
            $hosptail = Hosptail::findOrFail($id);
            return view('backEnd.hosptail.as_a_doctor',compact('hosptail'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['problem']);
        }

    }
    // get_search_lab function
    public function get_search_lab($id){
        $hosptail = Hosptail::findOrFail($id);
        return view('backEnd.hosptail.hosptail_lab_profile',compact('hosptail'));
    }
    //post_search_lab function
    public function post_search_lab($id,Request $request){
        $hosptail = Hosptail::findOrFail($id);
        $patient = Patien::with(['patient_analzes'])->where('IdCode','like','%' . $request->search . '%')->first();
        if($patient){
            return view('backEnd.hosptail.search_lab_hosptail',compact('patient','hosptail'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }

    public function get_search_xray($id){
        $hosptail = Hosptail::findOrFail($id);
        return view('backEnd.hosptail.hosptail_xray_profile',compact('hosptail'));
    }
    public function post_search_xray($id,Request $request){
        $hosptail = Hosptail::findOrFail($id);
        $patient = Patien::with(['patient_rays'])->where('IdCode','like','%' . $request->search . '%')->first();
        if($patient){
            return view('backEnd.hosptail.search_xray_hosptail',compact('patient','hosptail'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }



    public function get_search_pharmacy($id){
        $hosptail = Hosptail::findOrFail($id);
        return view('backEnd.hosptail.hosptail_pharmacy_profile',compact('hosptail'));
    }
    public function post_search_pharmacy($id,Request $request){
        $hosptail = Hosptail::findOrFail($id);
        $patient = Patien::with(['Raoucheh'])->where('idCode','like','%' . $request->search . '%')->first();
        if($patient){
            return view('backEnd.hosptail.search_pharmacy_hosptail',compact('patient','hosptail'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }

    public function hosptail_add_doctor($id,StoreDoctor $request){
        try{
            $doctor_data = $request->all();
        /* upload img */
        // doctor image
        if($request->image){
            $img = Image::make($request->image)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/doctor/hosptail/' . $request->image->hashName()));
            $doctor_data['image'] = $request->image->hashName();
        }
        // national id front image
        if($request->national_id_front_side){
            $national_id_front = Image::make($request->national_id_front_side)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctor/hosptail/' . $request->image->hashName()));
            $doctor_data['national_id_front_side'] = $request->national_id_front_side->hashName();
        }
        // national id back image
        if($request->national_id_back_side){
            $national_id_back_side = Image::make($request->national_id_back_side)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctor/hosptail/' . $request->national_id_back_side->hashName()));
            $doctor_data['national_id_back_side'] = $request->national_id_back_side->hashName();
        }

        if($request->phoneNumber[0] == '0'){
            $doctor_data['phoneNumber'] = substr($request->phoneNumber,1);
        }else{
             $doctor_data['phoneNumber'] = $request->phoneNumber;
        }
        $doctor_data['IdCode'] = $request->countryCode  . $doctor_data['phoneNumber'];
        $doctor_data['password'] = bcrypt($request->password);
        $doctor_data['hosptail_id'] = $request->hosptail_id;
        $hosptail = Hosptail::findOrFail($id);
        $doctor_create = Doctor::create($doctor_data);
        $doctor_create->branch()->attach($request->branch);
        // auth('doctor')->login($doctor_create);
        return redirect()->route('doctor_hosptail_verify',[$doctor_create['id'],$doctor_create['hosptail_id']]);
        }
        catch(\Exception $ex){

            return redirect()->back(['error' => 'problem']);
        }


            return redirect()->back();
        }



    // add result to rays
    /* hosptail add result to test [access xray] */
    public function addResult_rays($id,stogreAnalzes $request){
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
    /* hosptail add result to test [access xray] */

    // add result to analzes
    /* hosptail add result to ray [access lab] */
    public function addResult_analzes($id,stogreRay $request){
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
    public  function hosptail_child_add_Result_rays(StoreResultRay $request){
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
    public function hosptail_child_addResult_analzes(StoreResultTest $request){
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
    /* hosptail add result to ray [access lab] */
    public function loginDoctor($id){
        $hosptail = Hosptail::with('doctors','branch')->findOrFail($id);
        return view('backEnd.hosptail.doctor.login',compact('hosptail'));
    }

    public function post_loginDoctor($id,Request $request){
        try{
            $hosptail = Hosptail::findOrFail($id);
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
            return redirect()->route('hosptail.profile',$hosptail->id);
        }
        catch(\Exception $ex){
            return redirect()->back(['error' => 'problem']);
        }

    }
    // delete doctor //
     public function hosptail_delete_doctor($id,$doctor_id){
         $hosptail = Hosptail::findOrFail($id);
         $hosptail->doctors()->where('id',$doctor_id)->delete();
//         dd('done delete');
         return redirect()->route('loginDoctor',$hosptail->id);
      }
      // delete doctor //
      /* hosptail add patien */
      public function hosptail_add_patien(StorePatien $request){
        try{
            $request_data = $request->all();
        // dd($request->all());
        /* upload img */
        if($request->image){
            $img = Image::make($request->image)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/patien/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }
        /* secure password */
        $request_data['password'] = bcrypt($request->password);
        if($request->phoneNumber[0] == '0'){
            $request_data['phoneNumber'] = substr($request->phoneNumber,1);
        }else{
            $request_data['phoneNumber'] = $request_data['phoneNumber'];
        }
        $request_data['idCode'] = str_replace('+','P',$request_data['countryCode'])  . $request_data['phoneNumber'];
        // role = patient //
        $request_data['role'] = 'patient';
        $request_data['is_active'] = true;
        $request_data['hosptail_id'] = $request->hosptail_id;
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
    public function hosptail_old_prescription($id,$patien_id){
        $hosptail = Hosptail::findOrFail($id);
        $patient = Patien::with('Raoucheh','patient_analzes','patient_rays')->findOrFail($patien_id);
        return view('backEnd.hosptail.hosptail_old_prescrption',compact('patient','hosptail'));
    }
    /* hosptail branch page */
    public function hosptail_branch($id){
        $hosptail = Hosptail::findOrFail($id);
        return view('backEnd.hosptail.hosptail_branch',compact('hosptail'));
    }
    /* hosptail branch page */
    public function hosptail_login_branch($id,Request $request){
        // dd($request->all());
        $hosptail = Hosptail::findOrFail($id);
        $arr = [
            'Name' => 'required',
            'password'  => 'required',
        ];
        $vaild = Validator::make($request->all(),$arr);
        if($vaild->fails()){
            return redirect()->back();
        }
        $attmp = $request->only('Name','password');
        if(! Auth::guard('branch')->attempt($attmp)){
            return redirect()->back()->with('msg','Name code or password incorrect');
        }
        return redirect()->route('getAsBranch',[$hosptail->id,auth()->guard('branch')->user()->id]);
    }
    public function getAsBranch($id,$branch_id){
        $hosptail = Hosptail::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        return view('backEnd.branch.getAsBranch',compact('branch','hosptail'));
    }


    public function hosptail_add_dapartement($id, updateDepartement $request){
        try{
            $deparRequest = $request->all();
            $hosptail = Hosptail::findOrFail($id);
            $depar_update = $hosptail->update($deparRequest);
            return redirect()->route('loginDoctor',$id);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function getAllPrescription($id,$patient_id){
        $hosptail = Hosptail::findOrFail($id);
        $patient = Patien::with('Raoucheh','patient_analzes','patient_rays')->findOrFail($id);
        return view('backEnd.hosptail.hosptail_all_prescrption',compact('patient','hosptail'));
    }

    public function hosptail_welcome_doctor($id,$hosptail_id){
        $doctor = Doctor::findOrFail($id);
        $hosptail = Hosptail::findOrFail($hosptail_id);
        return view('backEnd.hosptail.hosptail_welcome_doctor',compact('doctor','hosptail'));
    }
    public function hosptail_branch_welcome_doctor($id,$hosptail_id,$branch_id){
        $doctor = Doctor::findOrFail($id);
        $hosptail = Hosptail::findOrFail($hosptail_id);
        $branch = Branch::findOrFail($branch_id);
        return view('backEnd.hosptail.hosptail_branch_welcome_doctor',compact('doctor','hosptail','branch'));
    }
    public function homepage($id){
        try{
            $hosptail = Hosptail::findOrFail($id);
            return view('backEnd.hosptail.homepage',compact('hosptail'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'back']);
        }
    }

    public function hosptailFindDoctor($id,Request $request){
        try{
            $hosptail = Hosptail::findOrFail($id);
            $doctors = OnlineDoctor::where('name',$request->doctorName)
            ->orwhere('speciality',$request->doctorName)
            ->count();
            if(!$doctors){
                Alert::error('Error Message','Doctor Not Found');
                return redirect()->back();
            }
            $doctors = OnlineDoctor::where('name',$request->doctorName)
            ->orwhere('speciality',$request->doctorName)
            ->get();
            return view('backEnd.hosptail.doctor.showResultDoctor',compact('hosptail','doctors'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function appointmentsDoctor(Request $request){
        try{
            // return $request;
            Alert::success('success Message','Doctor Added Successfuly');
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
                'hospital_id'   => $request->hosptail_id
            ]);
            return redirect()->back()->with(['success' => 'Doctor Added Successfuly']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'Problem']);
        }
    }

    public function hosptaildoctorAppoiement($id){
        try{
            $days = Day::get();
            $hosptail = Hosptail::findOrFail($id);
        $doctorAppoiment = hospitalAppointment::where('hospital_id',$hosptail->id)->get(['doctor_name','address','idCode','image','special','phoneNumber','doctor_id','appointments']);
            return view('backEnd.hosptail.doctor.doctorAppoiement',compact('hosptail','doctorAppoiment','days'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'Problem']);
        }

    }
    public function bookDocApp($id,addAppoiemntDoctor $request){
        try{
            Alert::success('Success','Booked Success');
            $hosptail = Hosptail::findOrFail($id);
            $doctor_id = hospitalAppointment::where('doctor_id',$request->doctor_id)
            ->where('hospital_id',$hosptail->id)
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
