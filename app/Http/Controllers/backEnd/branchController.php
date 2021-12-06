<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Hosptail;
use App\models\Clinic;
use App\models\Branch;
use App\models\Patien;
use App\Http\Requests\backEnd\branch\Store;
use App\Http\Requests\backEnd\branch\StoreDoctor;
use App\Http\Requests\backEnd\hosptail\StorePatien;
use App\Http\Requests\backEnd\branch\updateDepartement;
use App\models\Doctor;
use App\models\Lab;
use App\models\Pharmacy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\models\Xray;
class branchController extends Controller
{
    public function hosptail_add_branch(Store $request ,$id){
        try{
            $branch_data = $request->all();
            $hosptail = Hosptail::findOrFail($id);
            $hosptail->hosptail_branch = true;
            $hosptail->save();
            $branch_data['hosptail_id'] = $request->hosptail_id;
            $branch_data['password'] = bcrypt($request->password);
            $branch = Branch::create($branch_data);
            if($branch){
                return redirect()->route('hosptail_branch',$hosptail->id);
            }
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }


    }
    public function clinic_add_branch(Store $request ,$id){
        try{
            $branch_data = $request->all();
            $clinic = Clinic::findOrFail($id);
            $clinic->clinic_branch = true;
            $clinic->save();
            $branch_data['clinic_id'] = $request->clinic_id;
            $branch_data['password'] = bcrypt($request->password);
            $branch = Branch::create($branch_data);
            if($branch){
                return redirect()->route('clinic_branch',$clinic->id);
            }
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function logout($id){
        $hosptail = Hosptail::findOrFail($id);
        auth()->guard('branch')->logout();
        return redirect()->route('hosptail_login_branch',$id);
    }
    // branch login doctor //
    public function branch_login_doctor($id,$branch_id){
        $hosptail = Hosptail::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        return view('backEnd.branch.branch_login_doctor',compact('hosptail','branch'));
    }
    // branch login doctor //
    /* clinic_branch_login_doctor */
    public function clinic_branch_login_doctor($id,$branch_id){
        $clinic = Clinic::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        return view('backEnd.branch.clinic_branch_login_doctor',compact('clinic','branch'));
    }

    /* clinic_branch_login_doctor */
    public function branch_post_login_doctor($id,$branch_id,Request $request){
        $hosptail = Hosptail::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        //dd($request->all());
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
        return redirect()->route('branch_doctor_profile',[$hosptail->id,$branch->id]);
    }

    /* clinic branch login doctor */
    public function clinic_branch_post_login_doctor($id,$branch_id,Request $request){
        $clinic = Clinic::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        //dd($request->all());
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
        return redirect()->route('clinic_branch_doctor_profile',[$clinic->id,$branch->id]);
    }

    /* clinic branch login doctor */
    public function branch_add_doctor($id,$branch_id,StoreDoctor $request){
        //dd($request->all());
        try{
            $doctor_data = $request->all();
        /* upload img */
        // doctor image
        if($request->image){
            $img = Image::make($request->image)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/doctor/hosptail/branch/' . $request->image->hashName()));
            $doctor_data['image'] = $request->image->hashName();
        }
        // // national id front image
        if($request->national_id_front_side){
            $national_id_front = Image::make($request->national_id_front_side)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctor/hosptail/branch/' . $request->image->hashName()));
            $doctor_data['national_id_front_side'] = $request->national_id_front_side->hashName();
        }
        // // national id back image
        if($request->national_id_back_side){
            $national_id_back_side = Image::make($request->national_id_back_side)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctor/hosptail/branch/' . $request->national_id_back_side->hashName()));
            $doctor_data['national_id_back_side'] = $request->national_id_back_side->hashName();
        }

        if($request->phoneNumber[0] == '0'){
            $doctor_data['phoneNumber'] = substr($request->phoneNumber,1);
        }else{
             $doctor_data['phoneNumber'] = $request->phoneNumber;
        }
        $doctor_data['IdCode'] = $request->countryCode  . $doctor_data['phoneNumber'];

        $doctor_data['password'] = bcrypt($request->password);
        $doctor_data['branch'] = $request->branch_id;
        $hosptail = Hosptail::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        $doctor_create = Doctor::create($doctor_data);
        $doctor_create->branch()->attach($request->branch);
        // auth('doctor')->login($doctor_create);
        //return dd('true login doctor');
        return redirect()->route('doctor_hosptail_branch_verify',[$doctor_create['id'],$hosptail->id,$branch->id]);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    // branch add new doctor //

    /* clinic_branch_add_doctor */
    public function clinic_branch_add_doctor(StoreDoctor $request ,$id,$branch_id){
        try{
            $doctor_data = $request->all();
        /* upload img */
        // doctor image
        if($request->image){
            $img = Image::make($request->image)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/doctor/clinic/branch/' . $request->image->hashName()));
            $doctor_data['image'] = $request->image->hashName();
        }
        // // national id front image
        if($request->national_id_front_side){
            $national_id_front = Image::make($request->national_id_front_side)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctor/clinic/branch/' . $request->image->hashName()));
            $doctor_data['national_id_front_side'] = $request->national_id_front_side->hashName();
        }
        // // national id back image
        if($request->national_id_back_side){
            $national_id_back_side = Image::make($request->national_id_back_side)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctor/clinic/branch/' . $request->national_id_back_side->hashName()));
            $doctor_data['national_id_back_side'] = $request->national_id_back_side->hashName();
        }

        if($request->phoneNumber[0] == '0'){
            $doctor_data['phoneNumber'] = substr($request->phoneNumber,1);
        }else{
             $doctor_data['phoneNumber'] = $request->phoneNumber;
        }
        $doctor_data['IdCode'] = $request->countryCode  . $doctor_data['phoneNumber'];
        $doctor_data['password'] = bcrypt($request->password);
        $doctor_data['branch'] = $request->branch_id;
        $clinic = Clinic::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        $doctor_create = Doctor::create($doctor_data);
        $doctor_create->branch()->attach($request->branch);
        // auth('doctor')->login($doctor_create);
        //return dd('true login doctor');
        return redirect()->route('doctor_clinic_branch_verify',[$doctor_create['id'],$clinic->id,$branch->id]);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    /* clinic_branch_add_doctor */
    public function branch_add_patient($id,$branch_id, StorePatien $request){
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
        $request_data['hosptail_id'] = $request->hosptail_id;
        $branch_data['branch_id'] = $request->branch_id;
        // dd($request->all());
        // dd($request_data['code']);
        $hosptail = Hosptail::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        /* insert data */
        $patienData = Patien::create($request_data);
        // return redirect()->route();
        return redirect()->back();
    }
    // branch add new patient //

    // clinic branch add new patient //
    public function clinic_branch_add_patient($id,$branch_id, StorePatien $request){
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
        $branch_data['branch_id'] = $request->branch_id;
        // dd($request->all());
        // dd($request_data['code']);
        $clinic = Clinic::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        /* insert data */
        $patienData = Patien::create($request_data);
        // return redirect()->route();
        return redirect()->back();
        }

        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    // clinic branch add new patient //

    /* branch doctor profile */
    public function branch_doctor_profile($id,$branch_id){
        $hosptail = Hosptail::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        return view('backEnd.branch.branch_doctor_profile',compact('hosptail','branch'));
    }
    /* branch doctor profile */
    /* branch doctor profile */
    public function clinic_branch_doctor_profile($id,$branch_id){
        $clinic = Clinic::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        return view('backEnd.branch.clinic_branch_doctor_profile',compact('clinic','branch'));
    }
    /* branch doctor profile */
    /* branch_doctor_departement */
    public function branch_doctor_departement(updateDepartement $request , $id,$branch_id){
        $deparmentRequest = $request->all();
        $hosptail = Hosptail::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        $branch->update($deparmentRequest);
        return redirect()->route('branch_login_doctor',[$id,$branch_id]);

    }
    /* branch_doctor_departement */

    /* clinic_branch_doctor_departement */
    public function clinic_branch_doctor_departement(updateDepartement $request , $id,$branch_id){
        $deparmentRequest = $request->all();
        $clinic = Clinic::findOrFail($id);
        $branch = Branch::findOrFail($branch_id);
        $branch->update($deparmentRequest);
        return redirect()->route('clinic_branch_login_doctor',[$id,$branch_id]);

    }
    /* branch_doctor_departement */

    /* xray add branch */
    public function xray_add_branch(Store $request ,$id){
        //($request->all());
        $branch_data = $request->all();
        $xray = Xray::findOrFail($id);
        $xray->xray_branch = true;
        $xray->save();
        $branch_data['xray_id'] = $request->xray_id;
        $branch_data['password'] = bcrypt($request->password);
        $branch = Branch::create($branch_data);
        return redirect()->back();
    }

    public function labs_add_branch(Store $request ,$id){
        //dd($request->all());
        $branch_data = $request->all();
        $labs = Lab::findOrFail($id);
        $labs->labs_branch = true;
        $labs->save();
        $branch_data['lab_id'] = $request->lab_id;
        $branch_data['password'] = bcrypt($request->password);
        $branch = Branch::create($branch_data);
        return redirect()->back();
    }
    public function pharmacy_add_branch(Store $request ,$id){
        //dd($request->all());
        $branch_data = $request->all();
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->pharmacy_branch = true;
        $pharmacy->save();
        $branch_data['pharmacy_id'] = $request->pharmacy_id;
        $branch_data['password'] = bcrypt($request->password);
        $branch = Branch::create($branch_data);
        return redirect()->back();
    }

    public function branc_clinic_logout(){
        Auth::guard('branch')->logout();
        return redirect()->route('clinic_branch',auth()->guard('clinic')->id);
    }
    public function branch_hosLogout(){
        Auth::guard('branch')->logout();
        return redirect()->route('hosptail_branch',auth()->guard('hosptail')->id);
    }


}
