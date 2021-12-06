<?php

namespace App\Http\Controllers\backEnd;

use App\models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Lab;
use App\models\Patien;
use App\models\Branch;
use App\Http\Requests\backEnd\labs\Store;
use App\Http\Requests\backEnd\labs\Update;
use App\Http\Requests\backEnd\child\StoreResultRay;
use App\Http\Requests\backEnd\labs\addNewWork;
use App\Http\Requests\backEnd\patien\Store as PatienStore;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\models\Day;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\verifyLabs;
use App\models\StorgeRays;
use App\Http\Requests\backEnd\stogreRay;
use App\Http\Requests\backEnd\xray\StorePatien;
use App\models\AppointmentLab;
use App\models\clupTransaction;
use App\models\patient_rays;
use App\models\QrLab;
use App\models\RayChild;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class labsController extends Controller
{
    public function register(Request $request){
        try{
            $lab = $request->session()->get('labs');
            return view('backEnd.labs.register',compact('lab'));
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
        /* upload lab_License */
        if($request->labs_License){
            $img = Image::make($request->labs_License)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $request->labs_License->hashName()));
            $request_data['labs_License'] = asset('uploads/' . $request->labs_License->hashName());
        }
        /* secure password */
        $request_data['password'] = bcrypt($request->password);
        $request_data['password_confirmation'] = bcrypt($request->password_confirmation);
        // role = patient //
        $request_data['role'] = 'labs';
        if($request->phoneNumber[0] == '0'){
            $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
        }else{
             $request_data['phoneNumber'] =$request->countryCode . $request->phoneNumber;
        }
        $request_data['idCode'] = $request_data['phoneNumber'];
        $request_data['is_active'] = false;
        if(empty($request->session()->get('labs'))){
            $lab = new Lab();
            $lab->fill($request_data);
            $request->session()->put('labs', $lab);
        }else{
            $lab = $request->session()->get('labs');
            $lab->fill($request_data);
            $request->session()->put('labs', $lab);
        }
        /* insert data */
        // $lab_create = Lab::create($request_data);
            $lab = Lab::where('phoneNumber',$request_data['phoneNumber'])->first();
            if(!$lab){
                return redirect()->route('labs_verify');
            }
            return redirect()->back()->withInput($request->input())->with(['phoneMsg' => 'phoneNumber is exists!']);
        }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        }

    }
    public function labs_as_xray($id){
        $labs = Lab::findOrFail($id);
        return view('backEnd.labs.as_xray',compact('labs'));
    }
    /* function send email */
    public function sendEmail($id){
        $labs = Lab::findOrFail($id);
        Mail::to($labs->email)->send(new verifyLabs($labs));
        return redirect()->back()->with(['EmailMsg'=>'Check Your Email']);
    }
    /* end of function send email */
    public  function welcome($id){
        try{
            $labs = Lab::findOrFail($id);
            return view('backEnd.labs.welcomePage',compact('labs'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=> 'problem' ]);
        }
    }
    public function verifyLabs($id){
        $labs = Lab::findOrFail($id);
        $labs->verify = 1;
        $labs->save();
        auth()->guard('labs')->login($labs);
        return redirect()->route('labs.edit.profile',$labs->id);
    }
    /* function edit profile */
    public function editProfile($id){
        try{
            $labs = Lab::findOrFail($id);
            return view('backEnd.labs.edit',compact('labs'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* end of function */
    /* function update profile */
    public function updateProfile($id, Update $request){
        try{
            $labs = Lab::findOrFail($id);
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
                return redirect()->route('editLabVerify',$labs->id);
                // dd(session()->get('updatePhoneNumber'));
            }
            /* update image */
            if($request->image){
                $img = Image::make($request->image)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $request->image->hashName()));
                $request_data['image'] =asset('uploads/' .  $request->image->hashName());
            }

            if($request->labs_License){
                $img = Image::make($request->labs_License)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $request->labs_License->hashName()));
                $request_data['labs_License'] =asset('uploads/' .  $request->labs_License->hashName());
            }
            /* update image */
            $request_data['role'] = 'labs';
            if($request->phoneNumber[0] == '0'){
                $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            $request_data['Medical_License_Number'] = $request->Medical_License_Number;
            $labs->update($request_data);
            alert()->html("<img width=150 src='https://phistory.life/Phistory/public/imgs/alert/Don1e.png'>",false);
            return redirect()->back();
        }
        catch(\Exception $ex){
            return redirect()->back(['error' => 'problem']);
        }

    }
    /* end of function */
    public function profile($id){
        try{
            $labs = Lab::find($id);
            return view('backEnd.labs.profile',compact('labs'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function logout(){
        Auth::guard('labs')->logout();
        return redirect()->route('indexRoute');
    }

    /* function search patient form phone number */
    public function search($id,Request $request){
        $labs = Lab::findOrFail($id);
        $patient = Patien::with('patient_rays')->where('idCode',$request->search)
        ->where('online',true)
        ->first();
        if($patient){
            return view('backEnd.labs.search-patient',compact('patient','labs'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }
    /* function search patient form phone number */
    public function add_result_ray(Request $request){
        try{
            foreach(patient_rays::get() as $key => $ray){
                foreach($request->ray_id as $key => $id){
                    $r = patient_rays::findOrFail($id);
                    foreach($r->ray_name as $key => $name){
                        if($request->file('urlLink')){
                            $file = $request->file('urlLink');
                            $file_name = rand(100000,999999).$file->getClientOriginalName();
                            $file->move('uploads/pdf_file/result/rays/' , $file_name);
                        }
                        $r->link = ['URLLink' => asset('uploads/pdf_file/result/rays/' . $file_name),'name' => $name['ray_name']];
                        $r->save();
                        return redirect()->back()->with(['success_msg'=> 'test uploded successfuly']);
                    }
                }

            }
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public  function lab_child_add_Result_rays(Request $request){
        try{
            foreach (RayChild::get() as $ray){
                foreach($request->ray_child_id as $key=> $id){
                    $r = RayChild::findOrFail($id);
                    foreach($r->ray_name as $key => $name){
                        if($request->file('urlLink')){
                            $file = $request->file('urlLink');
                            $file_name = rand(100000,999999).$file->getClientOriginalName();
                            $file->move('public/uploads/pdf_file/result/rays/child/' , $file_name);
                        };
                        $r->link = ['URLLink' => asset('public/uploads/pdf_file/result/rays/child/' . $file_name),'name' => $name['ray_name']];
                        $r->save();
                        return redirect()->back()->with(['success_msg'=> 'ray uploded successfuly']);
                    }
                }
            }
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }


    }
     /* labs branch */
     public function labs_branch($id){
        $labs = Lab::findOrFail($id);
        return view('backEnd.labs.labs_branch',compact('labs'));
     }
    /* labs branch */
    /* labs login branch */
    public function labs_login_branch($id,Request $request){
        //dd($request->all());
        $labs = lab::findOrFail($id);
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
        return redirect()->route('labs_getAsBranch',[$labs->id,auth()->guard('branch')->user()->id]);
    }
    /* labs login branch */
    /* labs get As branch */
    public function labs_getAsBranch($id,$branch_id){
       $labs = Lab::findOrFail($id);
       $branch = Branch::findOrFail($branch_id);
       return view('backEnd.branch.labs_getAsBranch',compact('labs','branch'));
    }
    /* labs get As branch */
    public function homepage($id){
        try{
            $labs = Lab::findOrFail($id);
            return view('backEnd.labs.homepage',compact('labs'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'back']);
        }
    }
    public function getMywork($id){
        try{
            $labs = Lab::findOrFail($id);
            $days = Day::get();
            return view('backEnd.labs.getMywork',compact('labs','days'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function postMywork(addNewWork $request){
        try{
            Alert::success('Success','appointments Added Successfuly');
            $array = [
                'lab_id' => $request->lab_id,
                'doctor_name' => $request->lab_name,
                'address'       => $request->address,
                'idCode'        => $request->idCode,
                'phoneNumber'   => $request->phoneNumber,
                'appointments'  => $request->appointments,
                // 'wating'        => $request->wating,
                // 'fees'          => $request->fees,
                'latitude'      => $request->latitude,
                'longitude'     => $request->longitude
            ];
            AppointmentLab::create($array);
            return redirect()->back();
        }catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function orders($id){
        try{
            $labs = Lab::findOrFail($id);
            $labOrders = QrLab::get();
            return view('backEnd.labs.orders',compact('labs','labOrders'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function labAddPatient($id, PatienStore $request){
        try{
            $lab = Lab::findOrFail($id);
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
                $lab->point = $lab->point + 5;
                $lab->save();
                $clupTransction= clupTransaction::create([
                    'transaction'   => 'Add Patien',
                    'point'         => $lab->point,
                    'balance'       =>  $lab->point,
                    'lab_id'        => $lab->id
                ]);
                return redirect()->back()->with(['success' => 'patient Added Successfuly']);
            }
            return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);
        }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        }
    }


}
