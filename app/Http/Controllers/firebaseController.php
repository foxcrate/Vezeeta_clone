<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Patien;
use App\models\Hosptail;
use App\models\Clinic;
use App\models\Doctor;
use App\models\Xray;
use App\models\Lab;
use App\models\Pharmacy;
use App\Http\Requests\backEnd\patient_confirm_password;
use App\Http\Requests\backEnd\hosptail_confirm_password;
use App\models\Branch;
use App\models\clupTransaction;
use App\models\Nurse;
use App\models\OnlineDoctor;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class firebaseController extends Controller
{
    // patient edit profile
    public function editverify($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('testVerify.editVerify',compact('patient'));
            // dd(session()->get('updatePhoneNumber'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function editverifcationCode($id,Request $request){
        try{
            $patient = Patien::findOrFail($id);
            $patient->idCode = session()->get('updatePhoneNumber');
            $patient->idCode = str_replace('+','P',$patient->idCode);
            $patient->phoneNumber = $request->countryCode . session()->get('updatePhoneNumber');
            $patient->address = session()->get('updateaddress');
            $patient->latitude = session()->get('updatelatitude');
            $patient->longitude = session()->get('updatelongitude');
            $patient->save();
            Alert::success('msgUpdateData', 'data updated success');
            return redirect()->route('patien.homepage',$patient->id)->with(['msgUpdateData' => 'Data Updated Sussessfuly']);
        }catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    // online doctor edit profile
    public function editOnline_doctor_verify($id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            return view('testVerify.editonlineDoctorVerify',compact('online_doctor'));
            // dd(session()->get('updatePhoneNumber'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    // function editverifacation
    public function editVerifcationCodeOnline($id,Request $request){
        try{
            $onlineDoctor = OnlineDoctor::findOrFail($id);
            $onlineDoctor->idCode = session()->get('updatePhoneNumber');
            $onlineDoctor->idCode = str_replace('+','D',$onlineDoctor->idCode);
            $onlineDoctor->phoneNumber = $request->countryCode . session()->get('updatePhoneNumber');
            $onlineDoctor->address = session()->get('updateaddress');
            $onlineDoctor->latitude = session()->get('updatelatitude');
            $onlineDoctor->longitude = session()->get('updatelongitude');
            $onlineDoctor->save();
            Alert::success('msgUpdateData', 'data updated success');
            return redirect()->route('online_doctor.edit',$onlineDoctor->id)->with(['msgUpdateData' => 'Data Updated Sussessfuly']);
        }catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    // hosptail edit profile
    public function edithosptail_verify($id){
        try{
            $hosptail = Hosptail::findOrFail($id);
            return view('testVerify.edithosptailVerify',compact('hosptail'));
            // dd(session()->get('updatePhoneNumber'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function editVerifcationCodeHosptail($id,Request $request){
        try{
            $hosptail = Hosptail::findOrFail($id);
            $hosptail->idCode = session()->get('updatePhoneNumber');
            $hosptail->idCode = str_replace('+','H',$hosptail->idCode);
            $hosptail->phoneNumber = session()->get('updatePhoneNumber');
            $hosptail->address = session()->get('updateaddress');
            $hosptail->latitude = session()->get('updatelatitude');
            $hosptail->longitude = session()->get('updatelongitude');
            $hosptail->save();
            Alert::success('msgUpdateData', 'data updated success');
            return redirect()->route('hosptail.edit.profile',$hosptail->id)->with(['msgUpdateData' => 'Data Updated Sussessfuly']);
        }catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    // clinic edit profile
    public function editclinic_verify($id){
        try{
            $clinic = Clinic::findOrFail($id);
            return view('testVerify.editClinicVerify',compact('clinic'));
            // dd(session()->get('updatePhoneNumber'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function editVerifcationCodeClinic($id,Request $request){
        try{
            // return $request;
            $clinic = Clinic::findOrFail($id);
            $clinic->idCode = session()->get('updatePhoneNumber');
            $clinic->idCode = str_replace('+','C',$clinic->idCode);
            $clinic->phoneNumber = session()->get('updatePhoneNumber');
            $clinic->address = session()->get('updateaddress');
            $clinic->latitude = session()->get('updatelatitude');
            $clinic->longitude = session()->get('updatelongitude');
            $clinic->save();
            Alert::success('msgUpdateData', 'data updated success');
            return redirect()->route('clinic.edit.profile',$clinic->id)->with(['msgUpdateData' => 'Data Updated Sussessfuly']);
        }catch(\Exception $ex){
            // error
            Alert::error('Error', 'problem');
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    // xray edit profile
    public function editxray_verify($id){
        try{
            $xray = Xray::findOrFail($id);
            return view('testVerify.editXrayVerify',compact('xray'));
            // dd(session()->get('updatePhoneNumber'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function editVerifcationCodeXray($id,Request $request){
        try{
            // return $request;
            $xray = Xray::findOrFail($id);
            $xray->idCode = session()->get('updatePhoneNumber');
            $xray->idCode = str_replace('+','X',$xray->idCode);
            $xray->phoneNumber = session()->get('updatePhoneNumber');
            $xray->address = session()->get('updateaddress');
            $xray->latitude = session()->get('updatelatitude');
            $xray->longitude = session()->get('updatelongitude');
            $xray->save();
            Alert::success('msgUpdateData', 'data updated success');
            return redirect()->route('xray.edit.profile',$xray->id)->with(['msgUpdateData' => 'Data Updated Sussessfuly']);
        }catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    // lab edit profile
    public function editLab_verify($id){
        try{
            $lab = Lab::findOrFail($id);
            return view('testVerify.editLabVerify',compact('lab'));
            // dd(session()->get('updatePhoneNumber'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function editVerifcationCodeLab($id,Request $request){
        try{
            // return $request;
            $lab = Lab::findOrFail($id);
            $lab->idCode = session()->get('updatePhoneNumber');
            $lab->idCode = str_replace('+','L',$lab->idCode);
            $lab->phoneNumber = session()->get('updatePhoneNumber');
            $lab->address = session()->get('updateaddress');
            $lab->latitude = session()->get('updatelatitude');
            $lab->longitude = session()->get('updatelongitude');
            $lab->save();
            Alert::success('msgUpdateData', 'data updated success');
            return redirect()->route('labs.edit.profile',$lab->id)->with(['msgUpdateData' => 'Data Updated Sussessfuly']);
        }catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    // lab edit profile
    public function editPharmacy_verify($id){
        try{
            $pharmacy = Pharmacy::findOrFail($id);
            return view('testVerify.editPharmacyVerify',compact('pharmacy'));
            // dd(session()->get('updatePhoneNumber'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function editVerifcationCodePharmacy($id,Request $request){
        try{
            // return $request;
            $pharmacy = Pharmacy::findOrFail($id);
            $pharmacy->idCode = session()->get('updatePhoneNumber');
            $pharmacy->idCode = str_replace('+','Y',$pharmacy->idCode);
            $pharmacy->phoneNumber = session()->get('updatePhoneNumber');
            $pharmacy->address = session()->get('updateaddress');
            $pharmacy->latitude = session()->get('updatelatitude');
            $pharmacy->longitude = session()->get('updatelongitude');
            $pharmacy->save();
            Alert::success('msgUpdateData', 'data updated success');
            return redirect()->route('pharmacy.edit.profile',$pharmacy->id)->with(['msgUpdateData' => 'Data Updated Sussessfuly']);
        }catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    /* function show form verify */
    public function index(){
        try{
            return view('testVerify.index');
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=> 'problem']);
        }

    }
    /* end of function */

    /* verifcation code */
    public function verifcationCode(Request $request){
        try{
            // return session()->get('patient');
            $patientCreate = Patien::create([
                'firstName' => session()->get('patient')->firstName,
                'middleName' => session()->get('patient')->middleName,
                'lastName' => session()->get('patient')->lastName,
                'name' => session()->get('patient')->firstName . ' ' . session()->get('patient')->lastName,
                'BirthDate' => (new Carbon(session()->get('patient')->BirthDate))->timestamp,
                'gender'    => session()->get('patient')->gender,
                'email'    => session()->get('patient')->email,
                'password'  => session()->get('patient')->password,
                'password_confirmation' => session()->get('patient')->password_confirmation,
                'image'     => session()->get('patient')->image,
                'phoneNumber'   => session()->get('patient')->phoneNumber,
                'countryCode'   => session()->get('patient')->countryCode,
                'state'          => session()->get('patient')->state,
                'job'           => session()->get('patient')->job,
                'race'          => session()->get('patient')->race,
                'address'       => session()->get('patient')->address,
                'latitude'      => session()->get('patient')->latitude,
                'longitude'     => session()->get('patient')->longitude,
                'is_active'     => true,
                'idCode'        => str_replace('+','P',session()->get('patient')->idCode),
            ]);
             auth()->guard('patien')->login($patientCreate);
             $clupTransctionCreate = clupTransaction::create([
                 'transaction'  => 'Registeration',
                 'point'        => 50,
                 'balance'      => 50,
                 'patient_id'   => auth('patien')->user()->id,
             ]);
             return redirect()->route('patient.welcome',$patientCreate['id'])->with(['activeMsg'=> 'Your Account is active']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    /* end of function verifcation code */

    /* function show form verify */
    public function hosptail_verify(){
        try{
            return view('testVerify.hosptail_verify');
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    /* end of function */

    /* verifcation code */
    public function verifcationCodeHosptail(){
        try{
            $hosptailCreate = Hosptail::create([
                'image' => session()->get('hosptail')->image,
                'hosptailName'    => session()->get('hosptail')->hosptailName,
                'Primary_Speciality'    => session()->get('hosptail')->Primary_Speciality,
                'Medical_License_Number'    => session()->get('hosptail')->Medical_License_Number,
                'Hosptail_License'    => session()->get('hosptail')->Hosptail_License,
                'phoneNumber'   => session()->get('hosptail')->phoneNumber,
                'idCode'        => str_replace('+','H',session()->get('hosptail')->idCode),
                'telephone'     => session()->get('hosptail')->telephone,
                'Hotline'       => session()->get('hosptail')->Hotline,
                'password'      => session()->get('hosptail')->password,
                'password_confirmation' => session()->get('hosptail')->password_confirmation,
                'role'              => session()->get('hosptail')->role,
                'address'           => session()->get('hosptail')->address,
                'email'             => session()->get('hosptail')->email,
                'latitude'          => session()->get('hosptail')->latitude,
                'longitude'         => session()->get('hosptail')->longitude,
                'is_active'         => true
            ]);
            auth()->guard('clinic')->login($hosptailCreate);
            return redirect()->route('hosptail.welcome',$hosptailCreate['id'])->with(['activeMsg'=> 'Your Account is active']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* end of function verifcation code */

    /* function show form verify */
    public function clinic_verify(){
        return view('testVerify.clinic_verify');
    }
    /* end of function */

    /* verifcation code */
    public function verifcationCodeClinic(){
        try{
            // return session()->get('clinic');
        $clinicCreate = Clinic::create([
            'image' => session()->get('clinic')->image,
            'clinicName'    => session()->get('clinic')->clinicName,
            'Primary_Speciality'    => session()->get('clinic')->Primary_Speciality,
            'Medical_License_Number'    => session()->get('clinic')->Medical_License_Number,
            'Clinic_License'    => session()->get('clinic')->Clinic_License,
            'phoneNumber'   => session()->get('clinic')->phoneNumber,
            'idCode'        => str_replace('+','C',session()->get('clinic')->idCode),
            'telephone'     => session()->get('clinic')->telephone,
            'Hotline'       => session()->get('clinic')->Hotline,
            'password'      => session()->get('clinic')->password,
            'password_confirmation' => session()->get('clinic')->password_confirmation,
            'role'              => session()->get('clinic')->role,
            'address'           => session()->get('clinic')->address,
            'email'             => session()->get('clinic')->email,
            'latitude'          => session()->get('clinic')->latitude,
            'longitude'         => session()->get('clinic')->longitude,
            'is_active'         => true
        ]);
        auth()->guard('clinic')->login($clinicCreate);
        return redirect()->route('clinic.welcome',$clinicCreate['id'])->with(['activeMsg'=> 'Your Account is active']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* end of function verifcation code */

     /* function show form verify */
     public function xray_verify(){
         try{
            return view('testVerify.xray_verify');
         }catch(\Exception $ex){
             return redirect()->back()->with(['error' => 'problem']);
         }

    }
    /* end of function */

    /* verifcation code */
    public function verifcationCodeXray(Request $request){
        // return session()->get('xray');
        $xrayCreate = Xray::create([
            'image' => session()->get('xray')->image,
            'xrayName' => session()->get('xray')->xrayName,
            'xray_License'  => session()->get('xray')->xray_License,
            'Medical_License_Number'    => session()->get('xray')->Medical_License_Number,
            'phoneNumber' => session()->get('xray')->phoneNumber,
            'password_confirmation' => bcrypt(session()->get('xray')->password_confirmation),
            'countryCode' => session()->get('xray')->countryCode,
            'idCode' => str_replace('+','X',session()->get('xray')->idCode),
            'password'    => session()->get('xray')->password,
            'email'    => session()->get('xray')->email,
            'telephone'         => session()->get('xray')->telephone,
            'Hotline'           => session()->get('xray')->Hotline,
            'address'           => session()->get('xray')->address,
            'latitude'      => session()->get('xray')->latitude,
            'longitude'     => session()->get('xray')->longitude,
            'role'          => 'xray',
            'is_active'     => true,
        ]);
        auth()->guard('xray')->login($xrayCreate);
        $clupTransctionCreate = clupTransaction::create([
            'transaction'  => 'Registeration',
            'point'        => 50,
            'balance'      => 50,
            'xray_id'   => auth('xray')->user()->id
        ]);
        return redirect()->route('xray.welcome',$xrayCreate['id'])->with(['activeMsg'=> 'Your Account is active']);
    }
    /* end of function verifcation code */

    /* function show form verify */
    public function labs_verify(){
        try{
            return view('testVerify.labs_verify');
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    /* end of function */

    /* verifcation code */
    public function verifcationCodeLabs(){
        try{
            $labCreate = Lab::create([
                'image' => session()->get('labs')->image,
                'labsName' => session()->get('labs')->labsName,
                'labs_License'  => session()->get('labs')->labs_License,
                'Medical_License_Number'    => session()->get('labs')->Medical_License_Number,
                'phoneNumber' => session()->get('labs')->phoneNumber,
                'password_confirmation' => bcrypt(session()->get('labs')->password_confirmation),
                'countryCode' => session()->get('labs')->countryCode,
                'idCode' => str_replace('+','L',session()->get('labs')->idCode),
                'password'    => session()->get('labs')->password,
                'email'    => session()->get('labs')->email,
                'address'           => session()->get('labs')->address,
                'telephone'         => session()->get('labs')->telephone,
                'Hotline'           => session()->get('labs')->Hotline,
                'latitude'      => session()->get('labs')->latitude,
                'longitude'     => session()->get('labs')->longitude,
                'is_active'     => true,
                'role'          => 'labs',
            ]);
            auth()->guard('labs')->login($labCreate);
            $clupTransctionCreate = clupTransaction::create([
                'transaction'  => 'Registeration',
                'point'        => 50,
                'balance'      => 50,
                'lab_id'   => auth('labs')->user()->id
            ]);
            return redirect()->route('labs.welcome',$labCreate['id'])->with(['activeMsg'=> 'Your Account is active']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }


    }
    /* end of function verifcation code */
    /* function show form verify */
    public function pharmacy_verify(){
        try{
            return view('testVerify.pharmacy_verify');
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* end of function */

    /* verifcation code */
    public function verifcationCodepharmacy(){
        try{
            $pharmacyCreate = Pharmacy::create([
                'image' => session()->get('pharmacy')->image,
                'pharmacyName' => session()->get('pharmacy')->pharmacyName,
                'pharmacy_License'  => session()->get('pharmacy')->pharmacy_License,
                'Medical_License_Number'    => session()->get('pharmacy')->Medical_License_Number,
                'phoneNumber' => session()->get('pharmacy')->phoneNumber,
                'password_confirmation' => bcrypt(session()->get('pharmacy')->password_confirmation),
                'countryCode' => session()->get('pharmacy')->countryCode,
                'idCode' => str_replace('+','Y',session()->get('pharmacy')->idCode),
                'password'    => session()->get('pharmacy')->password,
                'email'    => session()->get('pharmacy')->email,
                'address'           => session()->get('pharmacy')->address,
                'telephone'         => session()->get('pharmacy')->telephone,
                'Hotline'           => session()->get('pharmacy')->Hotline,
                'latitude'      => session()->get('pharmacy')->latitude,
                'longitude'     => session()->get('pharmacy')->longitude,
                'is_active'     => true,
                'role'          => 'pharmacy',
            ]);
            auth()->guard('pharmacy')->login($pharmacyCreate);
            $clupTransctionCreate = clupTransaction::create([
                'transaction'  => 'Registeration',
                'point'        => 50,
                'balance'      => 50,
                'pharmacy_id'   => auth('pharmacy')->user()->id
            ]);
            return redirect()->route('pharmacy.welcome',$pharmacyCreate['id'])->with(['activeMsg'=> 'Your Account is active']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    /* end of function verifcation code */

    /* function show form verify */
    public function online_doctor_verify(){
        try{
            return view('testVerify.online_doctor_verify');
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* end of function */

    /* verifcation code */
    public function verifcationCodeOnline(){
        try{
            $doctorCreate = OnlineDoctor::create([
                'image' => session()->get('doctor')->image,
                'name' => session()->get('doctor')->name,
                'phoneNumber' => session()->get('doctor')->phoneNumber,
                'countryCode' => session()->get('doctor')->countryCode,
                'idCode' => str_replace('+','D',session()->get('doctor')->idCode),
                'password'    => session()->get('doctor')->password,
                'email'    => session()->get('doctor')->email,
                'degree'  => session()->get('doctor')->degree,
                'degree_image'     => session()->get('doctor')->degree_image,
                'license_image'   => session()->get('doctor')->license_image,
                'license_number'   => session()->get('doctor')->license_number,
                'information'          => session()->get('doctor')->information,
                'national_id_front_side'     => session()->get('doctor')->national_id_front_side,
                'national_id_back_side'          => session()->get('doctor')->national_id_back_side,
                'Nationality'       => session()->get('doctor')->Nationality,
                'speciality_id'     => session()->get('doctor')->speciality_id,
                'address'           => session()->get('doctor')->address,
                'latitude'      => session()->get('doctor')->latitude,
                'longitude'     => session()->get('doctor')->longitude,
                'is_active'     => true,
            ]);
             auth()->guard('online_doctor')->login($doctorCreate);
             $clupTransctionCreate = clupTransaction::create([
                'transaction'  => 'Registeration',
                'point'        => 50,
                'balance'      => 50,
                'doctor_id'   => auth('online_doctor')->user()->id
            ]);
             return redirect()->route('online_doctor.welcome',$doctorCreate['id'])->with(['activeMsg'=> 'Your Account is active']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* end of function verifcation code */

    /* function show form verify */
    public function nurse_verify(){
        return view('testVerify.nurse_verify');
    }
    /* end of function */

    /* verifcation code */
    public function verifcationCodenurse(){
        // try{
            $nurseCreate = Nurse::create([
                'image' => session()->get('nurese')->image,
                'name' => session()->get('nurese')->name,
                'phoneNumber' => session()->get('nurese')->phoneNumber,
                'countryCode' => session()->get('nurese')->countryCode,
                'idCode' => str_replace('+','N',session()->get('nurese')->idCode),
                'password'    => session()->get('nurese')->password,
                'email'    => session()->get('nurese')->email,
                'gender'  => session()->get('nurese')->gender,
                'address'           => session()->get('nurese')->address,
                'information'          => session()->get('nurese')->information,
                'national_id_front_side'     => session()->get('nurese')->national_id_front_side,
                'national_id_back_side'          => session()->get('nurese')->national_id_back_side,
                'national_id'       => session()->get('nurese')->national_id,
                'Nationality'       => session()->get('nurese')->Nationality,
                'latitude'      => session()->get('nurese')->latitude,
                'longitude'     => session()->get('nurese')->longitude,
                'is_active'     => true,
            ]);
            auth()->guard('nurse')->login($nurseCreate);
            $clupTransctionCreate = clupTransaction::create([
                'transaction'  => 'Registeration',
                'point'        => 50,
                'balance'      => 50,
                'nurse_id'   => auth('nurse')->user()->id
            ]);
            return redirect()->route('nurse.welcome',$nurseCreate['id'])->with(['activeMsg'=> 'Your Account is active']);
        // }catch(\Exception $ex){
        //     return redirect()->back()->with(['error' => 'problem']);
        // }

    }
    /* end of function verifcation code */
    public function doctor_verify($id,$clinic_id){
        $doctor = Doctor::findOrFail($id);
        $clinic = Clinic::findOrFail($clinic_id);
        return view('testVerify.doctor_verify',compact('doctor','clinic'));
    }
    /* end of function */

    /* verifcation code */
    public function verifcationCodedoctor($id,$clinic_id){
        $doctor = Doctor::findOrFail($id);
        $clinic = Clinic::findOrFail($clinic_id);
        $doctor->is_active = true;
        $doctor->IdCode = str_replace('+','D',$doctor->idCode);
        $doctor->save();
        auth()->guard('doctor')->login($doctor);
        return redirect()->route('clinic_welcome_doctor',[$doctor->id,$clinic->id])->with(['activeMsg'=> 'Your Account is active']);
    }
    /* end of function verifcation code */


    /* end of function verifcation code */
    public function doctor_hosptail_verify($id,$hosptail_id){
        $doctor = Doctor::findOrFail($id);
        $hosptail = Hosptail::findOrFail($hosptail_id);
        return view('testVerify.doctor_hosptail_verify',compact('doctor','hosptail'));
    }
    /* end of function */

    /* verifcation code */
    public function verifcationCodedoctor_hosptail($id,$hosptail_id){
        $doctor = Doctor::findOrFail($id);
        $hosptail = Hosptail::findOrFail($hosptail_id);
        $doctor->is_active = true;
        $doctor->IdCode = str_replace('+','D',$doctor->idCode);
        $doctor->save();
        auth()->guard('doctor')->login($doctor);
        return redirect()->route('hosptail_welcome_doctor',[$doctor->id,$hosptail->id])->with(['activeMsg'=> 'Your Account is active']);
    }
    /* end of function verifcation code */

    public function doctor_hosptail_branch_verify($id,$hosptail_id,$branch_id){
        $doctor = Doctor::findOrFail($id);
        $hosptail = Hosptail::findOrFail($hosptail_id);
        $branch = Branch::findOrFail($branch_id);
        return view('testVerify.doctor_hosptail_branch_verify',compact('doctor','hosptail','branch'));
    }

    public function verifcationCodedoctor_hosptail_branch($id,$hosptail_id,$branch_id){
        $doctor = Doctor::findOrFail($id);
        $hosptail = Hosptail::findOrFail($hosptail_id);
        $branch = Branch::findOrFail($branch_id);
        $doctor->is_active = true;
        $doctor->idCode = str_replace('+','D',$doctor->idCode);
        $doctor->save();
        auth()->guard('doctor')->login($doctor);
        return redirect()->route('hosptail_branch_welcome_doctor',[$doctor->id,$hosptail->id,$branch->id])->with(['activeMsg'=> 'Your Account is active']);

    }

    public function doctor_clinic_branch_verify($id,$clinic_id,$branch_id){
        $doctor = Doctor::findOrFail($id);
        $clinic = Clinic::findOrFail($clinic_id);
        $branch = Branch::findOrFail($branch_id);
        return view('testVerify.doctor_clinic_branch_verify',compact('doctor','clinic','branch'));
    }

    public function verifcationCodedoctor_clinic_branch($id,$clinic_id,$branch_id){
        $doctor = Doctor::findOrFail($id);
        $clinic = Clinic::findOrFail($clinic_id);
        $branch = Branch::findOrFail($branch_id);
        $doctor->is_active = true;
        $doctor->IdCode = str_replace('+','D',$doctor->idCode);
        $doctor->save();
        auth()->guard('doctor')->login($doctor);
        return redirect()->route('clinic_branch_welcome_doctor',[$doctor->id,$clinic->id,$branch->id])->with(['activeMsg'=> 'Your Account is active']);
    }




    /* forgot password functions */
    /* patient forgot password */

    public function patient_password($id){
        $patient = Patien::findOrFail($id);
        return view('forgot_password.index',compact('patient'));
    }

    public function post_patient_password(Request $request ,$id){
        $patient = Patien::findOrFail($id);
        // $patient->is_active = true;
        $patient->phoneNumber = str_replace('+','P',$patient->idCode);
        $patient->save();
        return redirect()->route('hosptail_confirm_password',$patient->id);
    }

    public function confirm_password($id){
        $patient = Patien::findOrFail($id);
        return view('forgot_password.confirm_patient_password',compact('patient'));
    }
    public function patient_confirm_password($id,patient_confirm_password $request){
        // return $request;
        // dd($request->all());
        $patient = Patien::findOrFail($id);
        // return $patient;
        $patient->password = bcrypt($request->new_password);
        $patient->password_confirmation = bcrypt($request->password_confirmation);
        // dd($patient->password_confirmation);
        $patient->update();
        return redirect()->route('indexRoute');
    }

    /* end forgot password patient */

    /* hosptail forgot password */
    public function hosptail_password($id){
        $hosptail = Hosptail::findOrFail($id);
        return view('forgot_password.hosptail_verify',compact('hosptail'));
    }

    public function post_hosptail_password(Request $request ,$id){
        $hosptail = Hosptail::findOrFail($id);
        // $patient->is_active = true;
        $hosptail->phoneNumber = str_replace('+','h',$hosptail->phoneNumber);
        $hosptail->save();
        return redirect()->route('get_hosptail_confirm_password',$hosptail->id);
    }

    public function hosptail_confirm_password($id){
        $hosptail = Hosptail::findOrFail($id);
        return view('forgot_password.confirm_hosptail_password',compact('hosptail'));
    }
    public function post_hosptail_confirm_password($id,patient_confirm_password $request){
        $hosptail = Hosptail::findOrFail($id);
        $hosptail->password = bcrypt($request->new_password);
        $hosptail->password_confirmation = bcrypt($request->password_confirmation);
        $hosptail->update();
        return redirect()->route('indexRoute');
    }

    /* end hosptail forgot password */



    /* clinic forgot password */
    public function clinic_password($id){
        $clinic = Clinic::findOrFail($id);
        return view('forgot_password.clinic_verify',compact('clinic'));
    }

    public function post_clinic_password(Request $request ,$id){
        $clinic = Clinic::findOrFail($id);
        // $patient->is_active = true;
        $clinic->phoneNumber = str_replace('+','c',$clinic->phoneNumber);
        $clinic->save();
        return redirect()->route('get_clinic_confirm_password',$clinic->id);
    }

    public function clinic_confirm_password($id){
        $clinic = Clinic::findOrFail($id);
        return view('forgot_password.confirm_clinic_password',compact('clinic'));
    }
    public function post_clinic_confirm_password($id,patient_confirm_password $request){
        $clinic = Clinic::findOrFail($id);
        $clinic->password = bcrypt($request->new_password);
        $clinic->password_confirmation = bcrypt($request->password_confirmation);
        $clinic->update();
        return redirect()->route('indexRoute');
    }

    /* end clinic forgot password */

    /* xray forgot password */
    public function xray_password($id){
        $xray = Xray::findOrFail($id);
        return view('forgot_password.xray_verify',compact('xray'));
    }

    public function post_xray_password(Request $request ,$id){
        $xray = Xray::findOrFail($id);
        // $patient->is_active = true;
        $xray->phoneNumber = str_replace('+','x',$xray->phoneNumber);
        $xray->save();
        return redirect()->route('get_xray_confirm_password',$xray->id);
    }

    public function xray_confirm_password($id){
        $xray = Xray::findOrFail($id);
        return view('forgot_password.confirm_xray_password',compact('xray'));
    }
    public function post_xray_confirm_password($id,patient_confirm_password $request){
        $xray = Xray::findOrFail($id);
        $xray->password = bcrypt($request->new_password);
        $xray->password_confirmation = bcrypt($request->password_confirmation);
        $xray->update();
        return redirect()->route('indexRoute');
    }

    /* end xray forgot password */


    /* labs forgot password */
    public function labs_password($id){
        $labs = Lab::findOrFail($id);
        return view('forgot_password.labs_verify',compact('labs'));
    }

    public function post_labs_password(Request $request ,$id){
        $labs = Lab::findOrFail($id);
        // $patient->is_active = true;
        $labs->phoneNumber = str_replace('+','l',$labs->phoneNumber);
        $labs->save();
        return redirect()->route('get_labs_confirm_password',$labs->id);
    }

    public function labs_confirm_password($id){
        $labs = Lab::findOrFail($id);
        return view('forgot_password.confirm_labs_password',compact('labs'));
    }
    public function post_labs_confirm_password($id,patient_confirm_password $request){
        $labs = Lab::findOrFail($id);
        $labs->password = bcrypt($request->new_password);
        $labs->password_confirmation = bcrypt($request->password_confirmation);
        $labs->update();
        return redirect()->route('indexRoute');
    }

    /* end labs forgot password */

    /* doctor forgot password */
    public function doctor_password($id){
        $doctor = OnlineDoctor::findOrFail($id);
        return view('forgot_password.online_doctor_verify',compact('doctor'));
    }

    public function post_doctor_password(Request $request ,$id){
        $doctor = OnlineDoctor::findOrFail($id);
        // $patient->is_active = true;
        $doctor->phoneNumber = $doctor->phoneNumber;
        $doctor->save();
        return redirect()->route('get_doctor_confirm_password',$doctor->id);
    }

    public function doctor_confirm_password($id){
        $doctor = OnlineDoctor::findOrFail($id);
        return view('forgot_password.confirm_doctor_password',compact('doctor'));
    }
    public function post_doctor_confirm_password($id,patient_confirm_password $request){
        $doctor = OnlineDoctor::findOrFail($id);
        $doctor->password = bcrypt($request->new_password);
        $doctor->password_confirmation = bcrypt($request->password_confirmation);
        $doctor->update();
        return redirect()->route('indexRoute');
    }

    /* end doctor forgot password */



}
