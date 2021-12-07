<?php

namespace App\Http\Controllers\backEnd;
use Illuminate\Http\Request;
use App\Http\Requests\backEnd\onlinedoctor\Store;
use App\Http\Requests\backEnd\onlinedoctor\Update;
use App\Http\Controllers\Controller;
use App\Http\Requests\backEnd\clinic\StoreRaoucata;
use App\Http\Requests\backEnd\onlinedoctor\AddNewWork;
use App\Http\Requests\backEnd\patien\Store as PatienStore;
use App\models\OnlineDoctor;
use App\models\DoctorSpecailty;
use App\models\Patien;
use App\models\API\Rays;
use App\models\patient_analzes;
use App\models\patient_rays;
use App\models\Raoucheh;
use App\models\API\analyzes;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\models\Day;
use App\models\Appointment;
use App\models\Child;
use App\models\clupTransaction;
use App\models\DoctorScudule;
use App\models\Medication2;
use App\models\patientData;
use App\models\QrDoctor;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;
use RealRashid\SweetAlert\Facades\Alert;
class onlineDoctorController extends Controller
{
    public function register(Request $request){
        try{
            $doctorSp = DoctorSpecailty::get();
            $doctor = $request->session()->get('doctor');
            return view("backEnd.online-doctor.register",compact('doctorSp','doctor'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    /* function register */
    public function postRegister(Store $request){
        //return "Alo";
        try{
            // return $request;
            $onlineDoctorRequest = $request->all();
            // if($request->image){
            //     $img = Image::make($request->image)
            //     ->resize(1280,400, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save(public_path('uploads/' . $request->image->hashName()));
            //     $onlineDoctorRequest['image'] = asset('uploads/' . $request->image->hashName());
            // }
            
            if($request->image){
                $hospitalRequest = $request->image;
                $image = $request->file('image');
                $input = $hospitalRequest = $image->getClientOriginalName();
                $destinationPath = public_path('uploads/');
                $image->move($destinationPath, $input);
                $onlineDoctorRequest['image'] = asset('uploads/' . $input);
                
            }
            
            // national id front image
            // if($request->national_id_front_side){
            //     $national_id_front = Image::make($request->national_id_front_side)
            //         ->resize(1280,400, function ($constraint) {
            //             $constraint->aspectRatio();
            //         })->save(public_path('uploads/' . $request->national_id_front_side->hashName()));
            //     $onlineDoctorRequest['national_id_front_side'] = asset('uploads/' . $request->national_id_front_side->hashName());
            // }
            
             if($request->national_id_front_side){
                $hospitalRequest = $request->national_id_front_side;
                $image = $request->file('national_id_front_side');
                $input = $hospitalRequest = $image->getClientOriginalName();
                $destinationPath = public_path('uploads/');
                $image->move($destinationPath, $input);
                $onlineDoctorRequest['national_id_front_side'] = asset('uploads/' . $input);
                
            }
            
            // national id back image
            // if($request->national_id_back_side){
            //     $national_id_back_side = Image::make($request->national_id_back_side)
            //         ->resize(1280,400, function ($constraint) {
            //             $constraint->aspectRatio();
            //         })->save(public_path('uploads/' . $request->national_id_back_side->hashName()));
            //     $onlineDoctorRequest['national_id_back_side'] = asset('uploads/' . $request->national_id_back_side->hashName());
            // }
            
            if($request->national_id_back_side){
                $hospitalRequest = $request->national_id_back_side;
                $image = $request->file('national_id_back_side');
                $input = $hospitalRequest = $image->getClientOriginalName();
                $destinationPath = public_path('uploads/');
                $image->move($destinationPath, $input);
                $onlineDoctorRequest['national_id_back_side'] = asset('uploads/' . $input);
                
            }
            
            // degree image
            // if($request->degree_image){
            //     $degree_image = Image::make($request->degree_image)
            //         ->resize(1280,400, function ($constraint) {
            //             $constraint->aspectRatio();
            //         })->save(public_path('uploads/' . $request->degree_image->hashName()));
            //     $onlineDoctorRequest['degree_image'] = $request->degree_image->hashName();
            // }
            
              if($request->degree_image){
                $hospitalRequest = $request->degree_image;
                $image = $request->file('degree_image');
                $input = $hospitalRequest = $image->getClientOriginalName();
                $destinationPath = public_path('uploads/');
                $image->move($destinationPath, $input);
                $onlineDoctorRequest['degree_image'] = asset('uploads/' . $input);
                
            }
            
            // license_image
            // if($request->license_image){
            //     $license_image = Image::make($request->license_image)
            //         ->resize(1280,400, function ($constraint) {
            //             $constraint->aspectRatio();
            //         })->save(public_path('uploads/' . $request->license_image->hashName()));
            //     $onlineDoctorRequest['license_image'] = $request->license_image->hashName();
            // }
            
            if($request->license_image){
                $hospitalRequest = $request->license_image;
                $image = $request->file('license_image');
                $input = $hospitalRequest = $image->getClientOriginalName();
                $destinationPath = public_path('uploads/');
                $image->move($destinationPath, $input);
                $onlineDoctorRequest['license_image'] = asset('uploads/' . $input);
            }          
            
            $onlineDoctorRequest['password'] = bcrypt($request->password);
            if($request->phoneNumber[0] == '0'){
                $onlineDoctorRequest['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $onlineDoctorRequest['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            $onlineDoctorRequest['idCode'] = $onlineDoctorRequest['phoneNumber'];
            if(empty($request->session()->get('doctor'))){
                $doctor = new OnlineDoctor();
                $doctor->fill($onlineDoctorRequest);
                $request->session()->put('doctor', $doctor);
            }else{
                $doctor = $request->session()->get('doctor');
                $doctor->fill($onlineDoctorRequest);
                $request->session()->put('doctor', $doctor);
            }
            $doctorPhone = OnlineDoctor::where('phoneNumber',$onlineDoctorRequest['phoneNumber'])->first();
            if(!$doctorPhone){
                return redirect()->route('online_doctor_verify');
            }
            return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);
            // $onlineDoctorCreate = OnlineDoctor::create($onlineDoctorRequest);

        }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        }
    }
    /* end function register */
    /* welcome function */
    public function welcome($id){
        $online_doctor = OnlineDoctor::findOrFail($id);
        return view('backEnd.online-doctor.welcomePage',compact('online_doctor'));
    }
    /* end welcome function */
    /* profile function */
    public function profile($id){
        $online_doctor = OnlineDoctor::with('special')->findOrFail($id);
        return view("backEnd.online-doctor.profile",compact('online_doctor'));
    }
    /* profile function */

    /* onlinedoctor logout */
    public function logout(){
        Auth::guard('online_doctor')->logout();
        return redirect()->route("indexRoute");
    }
    /* onlinedoctor logout */

    /* function show doctors */

    public function showDoctors($id,$special_id){
        $patient = Patien::find($id);
        $spdoctors = DoctorSpecailty::with('onlineDoctor')->find($special_id);
        return view("backEnd.online-doctor.showDoctors",compact('spdoctors','patient'));
    }

    /* function show doctors */
    public function show_profile_doctor($id,$doctor_id){
        try{
            $patient = Patien::find($id);
            $online_doctor = OnlineDoctor::find($doctor_id);
            return view("backEnd.online-doctor.show_profile_doctor",compact('patient','online_doctor'));
        }
        catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back();
        }

    }

    public function edit($id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            $doctorSp = DoctorSpecailty::get();
            return view("backEnd.online-doctor.edit",compact('online_doctor','doctorSp'));
        }
        catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back();
        }

    }
    public function UpdateRegister($id,Update $request){
        // try{
        //return "Alo";
            $onlineDoctorRequest = $request->all();
            $online_doctor = OnlineDoctor::findOrFail($id);
            // check phone number != oldphonenumber
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
                $requestData['license_number'] = $request->license_number;
                // $patient->update($requestData);
                $setSession = $request->session()->put('updatePhoneNumber',$requestData['phoneNumber']);
                $setSessionadd = $request->session()->put('updateaddress',$requestData['address']);
                $setSessionlat = $request->session()->put('updatelatitude',$requestData['latitude']);
                $setSessionlong = $request->session()->put('updatelongitude',$requestData['longitude']);
                return redirect()->route('editDoctorVerify',$online_doctor->id);
                // dd(session()->get('updatePhoneNumber'));
            }
            if($request->image){
                $img = Image::make($request->image)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $request->image->hashName()));
                $onlineDoctorRequest['image'] = asset('uploads/' . $request->image->hashName());
            }
            // national id front image
            if($request->license_image){
                $national_id_front = Image::make($request->license_image)
                    ->resize(1280,400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/' . $request->license_image->hashName()));
                $onlineDoctorRequest['license_image'] = asset('uploads/' . $request->license_image->hashName());
            }
            if($request->phoneNumber[0] == '0'){
                $onlineDoctorRequest['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $onlineDoctorRequest['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            // $request_data['idCode'] = str_replace('+','D',$request->countryCode) . $onlineDoctorRequest['phoneNumber'];
            $onlineDoctorRequest['address'] = $request->address;
            $onlineDoctorRequest['latitude'] = $request->latitude;
            $onlineDoctorRequest['longitude'] = $request->longitude;
            $onlineDoctorRequest['license_number'] = $request->license_number;
            $online_doctor->update($onlineDoctorRequest);
            alert()->html("<img width=150 src='https://phistory.life/Phistory/public/imgs/alert/Don1e.png'>",false);
        return redirect()->route('online_doctor.homepage',$online_doctor->id);
        // }
        // catch(\Exception $ex){
        //     Alert::error('Error','problem');
        //     return redirect()->back();
        // }
    }

    public function online_doctor_show_profile_patient($id,$patient_id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            return view('backEnd.online-doctor.online_doctor_show_profile_patient',compact('online_doctor','patient'));
        }
        catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back();
        }

    }

    public function add_prescription_patient( $id,$patient_id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $analyzes = analyzes::get();
            $rays = Rays::get();
            return view('backEnd.online-doctor.online_doctor_add_prescription',compact('online_doctor','patient','rays','analyzes'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

    }
    public function post_add_prescription_patient(StoreRaoucata $request,$id,$patient_id){
        // try{
            Alert::success('Success','prescription added successfuly');
            $online_doctor = OnlineDoctor::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $request_data = $request->all();
            if(isset($request_data['medication']) && count($request_data['medication']) > 0){
                foreach($request_data['medication'] as $item => $v){
                    $roaucata_data = [
                        'prescription'  => $request->prescription,
                        'weight'        => $request->weight,
                        'date'          => now()->timestamp,
                        'temperature'   => $request->temperature,
                        'blood_pressure'=> $request->blood_pressure,
                        'diabetics'     => $request->diabetics,
                        'jaw_type'      => $request->jaw_type,
                        'jaw_direction' => $request->jaw_direction,
                        'teeth_type'    => $request->teeth_type,
                        'eye_type'      => $request->eye_type,
                        'medication'    => $request->medication,
                        'patient_id'    => $request->patient_id,
                        'online_doctor_id'     => $request->online_doctor_id,
                    ];
                }
            }
            $roaucataCreate = Raoucheh::create($roaucata_data);


        if(isset($request_data['testName']) && count($request_data['testName']) > 0){
            foreach($request_data['testName'] as $item => $v){
                $test_data = [
                    'test_name'=> $request->testName,
                    'date'          => now()->timestamp,
                    'patient_id'    => $request->patient_id,
                    'online_doctor_id'     => $request->online_doctor_id,
                    'rocata_id'     => $roaucataCreate->id
                ];
            }
        }
        $testCreate = patient_analzes::create($test_data);
        if(isset($request_data['rayName']) && count($request_data['rayName']) > 0){
            foreach($request_data['rayName'] as $item => $v){
                $ray_data = [
                    'ray_name'  => $request->rayName,
                    'date'          => now()->timestamp,
                    'patient_id'    => $request->patient_id,
                    'online_doctor_id'     => $request->online_doctor_id,
                    'rocata_id'     => $roaucataCreate->id
                ];
            }
        }
        $ray_create = patient_rays::create($ray_data);

        $user = $patient;
        $rocata = Raoucheh::latest()->first();
        $test = patient_analzes::latest()->first();
        $ray = patient_rays::latest()->first();
        $user->notify(new \App\Notifications\addPrescription($rocata,$test,$ray,$user));
        return redirect()->back();
        // }
        // catch(\Exception $ex){
        //     Alert::error('Error','problem');
        //     return redirect()->back();
        // }

    }


    public function homepage($id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            return view('backEnd.online-doctor.homepage',compact('online_doctor'));
        }
        catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back();
        }
    }

    public function getMyWork($id){
        try{
            $days = Day::get();
            $online_doctor = OnlineDoctor::findOrFail($id);
            return view('backEnd.online-doctor.getMyWork',compact('online_doctor','days'));
        }
        catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back();
        }

    }

    public function post_add_mywork(AddNewWork $request){
        // try{
            Alert::success('Success','appointments Added Successfuly');
            // return $request;
            $request_data = $request->all();
            if(isset($request_data['appointments']) && count($request_data['appointments']) > 0){
                foreach($request_data['appointments'] as $key=>$val){
                    $array = [
                        'doctor_id' => $request->doctor_id,
                        'doctor_name' => $request->doctor_name,
                        'address'       => $request->address,
                        'special'       => $request->special,
                        'idCode'        => $request->idCode,
                        'phoneNumber'   => $request->phoneNumber,
                        'appointments'  => $request->appointments,
                        'wating'        => $request->wating,
                        'fees'          => $request->fees,
                        'latitude'      => $request->latitude,
                        'longitude'     => $request->longitude
                    ];
                    $AppointmentCreate = Appointment::create($array);
                    return redirect()->back();
                    // return $array;
                }
            }
        // }
        // catch(\Exception $ex){
        //     Alert::error('Error','problem');
        //     return redirect()->back();
        // }
    }

    public function update_online(Request $request,$id){
        try{
            Alert::success('Success','Updated Online Success');
            // dd($request->all());
            $online_doctor = OnlineDoctor::findOrFail($id);
            if($request->has('online'))
                $request->request->add(['online' => 1]);
            else
                $request->request->add(['online' => 0]);
            $online_doctor->update($request->all());
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }


    }
    public function update_homecare(Request $request,$id){
        try{
            Alert::success('Success','Updated Homecare Success');
            // dd($request->all());
            $online_doctor = OnlineDoctor::findOrFail($id);
            if($request->has('homecare'))
                $request->request->add(['homecare' => 1]);
            else
                $request->request->add(['homecare' => 0]);
            $online_doctor->update($request->all());
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back();
        }


    }
    public function get_searchPatient($id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            return view('backEnd.online-doctor.search_patient',compact('online_doctor'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

    }
    public function post_searchPatient($id,Request $request){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            $analyzes = analyzes::get();
            $rays = Rays::get();
            $patient = Patien::with(['patient_analzes','patient_rays','Raoucheh'])->where('IdCode',$request->search)
            ->where('online',1)->first();
            if(!$patient){
                Alert::error('Error','Patient Not Found');
                return redirect()->back();
            }
            return redirect()->route('doctor_profile_patient',compact('online_doctor','patient','analyzes','rays'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
        }

    }

    public function get_profile_patient($id,$patient_id){
        try{
            $meds = Medication2::get(['name']);
            $online_doctor = OnlineDoctor::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $analyzes = analyzes::get();
            $rays = Rays::get();
            return view('backEnd.online-doctor.patient_profile',compact('meds','online_doctor','patient','analyzes','rays'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function show_profile_patient ($id,$patient_id){
        $online_doctor = OnlineDoctor::findOrFail($id);
        $patient = Patien::findOrFail($patient_id);
        return view('backEnd.online-doctor.doctor_show_profile_patient',compact('online_doctor','patient'));
    }

    public function getDoctorSchedules($id){
        try{
            $online_doctor = OnlineDoctor::find($id);
            if(!$online_doctor){
                Alert::error('Error','Doctor Not Found');
                return redirect()->back();
            }
            return view('backEnd.online-doctor.get_doctor_schedules',compact('online_doctor'));

        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
        }

    }

    public function acceptSchedules($id){
        try{
            Alert::success('Success','Success Updated');
            $doctor_sch = DoctorScudule::findOrFail($id);
            $doctor_sch->is_accept = 1;
            $doctor_sch->save();
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

        // return $doctor_sch->is_accept;
    }
    public function declineSchedules($id){
        try{
            Alert::success('Success','Success Deleted');
            $doctor_sch = DoctorScudule::findOrFail($id);
            $doctor_sch->delete();
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }
    public function doctor_all_children ($doctor_id,$patient_id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($doctor_id);
            $patient = Patien::findOrFail($patient_id);
            return view('backEnd.online-doctor.doctor_all_children',compact('online_doctor','patient'));
        }
        catch(\Exception $ex){
            Alert::error('error','Problem');
            return redirect()->back();
        }
    }
    public function doctor_show_profile_child($doctor_id,$patient_id,$child_id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($doctor_id);
            $patient = Patien::findOrFail($patient_id);
            $child = Child::findOrFail($child_id);
            return view('backEnd.online-doctor.doctor_show_profile_child',compact('online_doctor','patient','child'));
        }
        catch(\Exception $ex){
            Alert::error('error','Problem');
            return redirect()->back();
        }

    }
    public function doctor_add_prescrption_child($doctor_id,$patient_id,$child_id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($doctor_id);
            $patient = Patien::findOrFail($patient_id);
            $child = Child::findOrFail($child_id);
            $rays = Rays::get();
            $tests  = analyzes::get();
            return view('backEnd.online-doctor.doctor_add_prescription_child',compact('online_doctor','patient','child','rays','tests'));
        }
        catch(\Exception $ex){
            Alert::error('error','Problem');
            return redirect()->back();
        }
    }

    public function reportPatien($id,$patient_id,Request $request){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $lastCheckup = Patien::with(['checkup'])->findOrFail($patient_id);
            return view('backEnd.online-doctor.reportPatien',compact('online_doctor','patient','lastCheckup'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function orders($id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            $doctorQr = QrDoctor::get();
            return view('backEnd.online-doctor.orders',compact('online_doctor','doctorQr'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function getAllPrescription($id,$patient_id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            $patient = Patien::with(['Raoucheh','patient_analzes','patient_rays'])->findOrFail($patient_id);
            return view('backEnd.online-doctor.getAllPrescription',compact('online_doctor','patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function getOldlPrescription($id,$patient_id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($id);
            $patient = Patien::with(['Raoucheh','patient_analzes','patient_rays'])->findOrFail($patient_id);
            return view('backEnd.online-doctor.getOldPrescription',compact('online_doctor','patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function online_doctor_add_patient(PatienStore $request,$id){
        try{
            // return $request;
            Alert::success('success','patient Added Successfuly');
            $online_doctor = OnlineDoctor::findOrFail($id);
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
                // dd($online_doctor);
                $online_doctor->poients = $online_doctor->poients + 5;
                $online_doctor->poients;
                $online_doctor->save();
                $clupTransction= clupTransaction::create([
                    'transaction'   => 'Add Patien',
                    'point'         =>5,
                    'balance'       =>  $online_doctor->poients,
                    'doctor_id'     => $online_doctor->id
                ]);
                return redirect()->back()->with(['success' => 'patient Added Successfuly']);
            }
            return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);
        }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        }
    }
    // doctor update patient profile
    public function doctorUpdatePatientProfile($id,$patient_id, Request $request){
        $online_doctor = OnlineDoctor::findOrFail($id);
        $patient = Patien::findOrFail($patient_id);
        $patienData = patientData::where('patient_id',$patient_id)->first();
        $requestData = $request->all();
        /* check allergi name of count > 0 */
        $data2 = [
            'agree_name'            => $request->agree_name,
            'surgery_data'          => $request->surgery_data,
            'medication_name' => $request->medication_name,
            'patient_id'              =>$patient_id,
           ];

        /* create data in table patient Data */

        // $data2['online'] = 1;
        $patienData->update($data2);
        return redirect()->back();
    }

    public function getAnalzes($doctor_id,$id,$patient_id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($doctor_id);
            $patient = Patien::findOrFail($patient_id);
            $rocata = Raoucheh::with(['patient_analzes'])
            ->whereHas('patient_analzes')
            ->where('patient_id',$patient->id)
            ->findOrFail($id);
            return view('backEnd.online-doctor.getAnalzes',compact('online_doctor','patient','rocata'));
        }catch(\Exception $ex){
            return redirect()->back();
        }

    }

    public function getRays($doctor_id,$id,$patient_id){
        try{
            $online_doctor = OnlineDoctor::findOrFail($doctor_id);
            $patient = Patien::findOrFail($patient_id);
            $rocata = Raoucheh::with(['patient_rays'])
            ->whereHas('patient_analzes')
            ->where('patient_id',$patient->id)
            ->findOrFail($id);
            return view('backEnd.online-doctor.getRays',compact('online_doctor','patient','rocata'));
        }catch(\Exception $ex){
            return redirect()->back();
        }
    }

}
