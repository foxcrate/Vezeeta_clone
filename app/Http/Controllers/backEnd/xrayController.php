<?php

namespace App\Http\Controllers\backEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Xray;
use App\models\Patien;
use App\models\Branch;
use App\Http\Requests\backEnd\xray\Store;
use App\Http\Requests\backEnd\child\StoreResultTest;
use App\Http\Requests\backEnd\patien\Store as PatienStore;
use App\Http\Requests\backEnd\xray\Update;
use Illuminate\Support\Facades\Mail;
use App\Mail\verifyXray;
use App\models\StorgeAnalazes;
use App\models\Result;
use App\Http\Requests\backEnd\stogreAnalzes;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\backEnd\xray\StorePatien;
use App\models\AppointmentLab;
use App\models\clupTransaction;
use App\models\Day;
use App\models\patient_analzes;
use App\models\QrXray;
use App\models\TestChild;
use Carbon\Carbon;
class xrayController extends Controller
{
    /* function register */
    public function register(Request $request){
        $xray = $request->session()->get('xray');
        return view('backEnd.xray.register',compact('xray'));
    }
    /* end of function */
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
        /* upload Clinic_License */
        if($request->xray_License){
            $img = Image::make($request->xray_License)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $request->xray_License->hashName()));
            $request_data['xray_License'] = asset('uploads/' . $request->xray_License->hashName());
        }
        /* secure password */
        $request_data['password'] = bcrypt($request->password);
        // role = patient //
        $request_data['role'] = 'xray';
        if($request->phoneNumber[0] == '0'){
            $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
        }else{
             $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
        }
        $request_data['idCode'] = $request_data['phoneNumber'];
        $request_data['role'] = 'xray';
        if(empty($request->session()->get('xray'))){
            $xray = new Xray();
            $xray->fill($request_data);
            $request->session()->put('xray', $xray);
        }else{
            $xray = $request->session()->get('xray');
            $xray->fill($request_data);
            $request->session()->put('xray', $xray);
        }
        /* insert data */
        // $xray_create = Xray::create($request_data);
        // return redirct //
        return redirect()->route('xray_verify');
        // return redirect()->back()->with(['verifyMsg'=>'Check Your Email']);
        }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        }

    }
    /* end of function */
    public  function xray_as_lab($id){
        $xray = Xray::findOrFail($id);
        return view('backEnd.xray.as_lab',compact('xray'));
    }
     /* function send email */
     public function sendEmail($id){
        $xray = Xray::findOrFail($id);
        Mail::to($xray->email)->send(new verifyXray($xray));
        return redirect()->back()->with(['EmailMsg'=>'Check Your Email']);
     }
    /* end of function send email */
    public  function welcome($id){
        $xray = Xray::findOrFail($id);
        return view('backEnd.xray.welcomePage',compact('xray'));
    }
    public function verifyXray($id){
        $xray = Xray::findOrFail($id);
        $xray->verify = 1;
        $xray->save();
        auth()->guard('xray')->login($xray);
        return redirect()->route('xray.edit.profile',$xray->id);
    }
    /* function edit profile */
    public function editProfile($id){
        $xray = Xray::findOrFail($id);
        return view('backEnd.xray.edit',compact('xray'));
    }
    /* end of function */
    /* function update profile */
    public function updateProfile($id, Update $request){
        try{
            $xray = Xray::findOrFail($id);
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
                $requestData['Medical_License_Number'] = $request->Medical_License_Number;
                // $patient->update($requestData);
                $setSession = $request->session()->put('updatePhoneNumber',$requestData['phoneNumber']);
                $setSessionadd = $request->session()->put('updateaddress',$requestData['address']);
                $setSessionlat = $request->session()->put('updatelatitude',$requestData['latitude']);
                $setSessionlong = $request->session()->put('updatelongitude',$requestData['longitude']);
                return redirect()->route('editXrayVerify',$xray->id);
                // dd(session()->get('updatePhoneNumber'));
            }
            /* update image */
            if($request->image){
                $img = Image::make($request->image)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $request->image->hashName()));
                $request_data['image'] = asset('uploads/' . $request->image->hashName());
            }
            if($request->xray_License){
                $img = Image::make($request->xray_License)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $request->xray_License->hashName()));
                $request_data['xray_License'] = asset('uploads/' . $request->xray_License->hashName());
            }
            if($request->phoneNumber[0] == '0'){
                $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            /* update image */
            $requestData['Medical_License_Number'] = $request->Medical_License_Number;
            $xray->update($request_data);
            alert()->html("<img width=150 src='https://phistory.life/Phistory/public/imgs/alert/Don1e.png'>",false);
            return redirect()->back();
        }
        catch(\Exception $ex){
            return redirect()->back(['error' => 'problem']);
        }

    }
    /* end of function */
    /* function profile */
    public function profile($id){
        $xray = Xray::find($id);
        return view('backEnd.xray.profile',compact('xray'));
    }
    /* end of function */
    /* function logout */
    public function logout(){
        Auth::guard('xray')->logout();
        return redirect()->route('indexRoute');
    }
    /* end of function */
    /* function search patient form phone number */
    public function search($id,Request $request){
        $xray = Xray::findOrFail($id);
        $patient = Patien::with('patient_analzes')->where('idCode',$request->search)->first();
        if($patient){
            return view('backEnd.xray.search-patient',compact('patient','xray'));
        }else{
            return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
        }
    }
    /* function search patient form phone number */
    /* function add result to test */
    public function add_result_test(Request $request){
        try{
            foreach(patient_analzes::get() as $test){
                foreach($request->test_id as $key=> $id){
                    $p = patient_analzes::findOrFail($id);
                    foreach($p->test_name as  $key=>$name){
                        if($request->file('urlLink')){
                            $file = $request->file('urlLink');
                            $file_name = rand(100000,999999).$file->getClientOriginalName();
                            $file->move('public/uploads/pdf_file/result/analzes/' , $file_name);
                        }
                        $p->link = ['URLLink' => asset('public/uploads/pdf_file/result/analzes/' . $file_name),'name' => $name['test_name']];
                        $p->save();
                        return redirect()->back()->with(['success_msg'=> 'test uploded successfuly']);
                        // dd(true);
                    }
                }

            }
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* function add result to test */
    public function xray_child_addResult_analzes(Request $request){
        try{
            foreach (TestChild::get() as $test){
                foreach($request->test_child_id as $key=> $id){
                    $t = TestChild::findOrFail($id);
                    foreach($t->test_name as $key => $name){
                        if($request->file('urlLink')){
                            $file = $request->file('urlLink');
                            $file_name = rand(100000,999999).$file->getClientOriginalName();
                            $file->move('public/uploads/pdf_file/result/analzes/child/' , $file_name);
                        };
                        $t->link = ['URLLink' => asset('public/uploads/pdf_file/result/analzes/child' . $file_name),'name' => $name['test_name']];
                        $t->save();
                        return redirect()->back()->with(['success_msg'=> 'test uploded successfuly']);
                    }
                }
            }
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    // public function xray_add_patien(StorePatien $request , $id){
    //     $request_data = $request->all();
    //     $xray = Xray::findOrfail($id);
    //     if($request->image){
    //         $img = Image::make($request->image)
    //         ->resize(1280,400, function ($constraint) {
    //             $constraint->aspectRatio();
    //         })->save(public_path('uploads/patien/' . $request->image->hashName()));
    //         $request_data['image'] = $request->image->hashName();
    //     }
    //     /* secure password */
    //     $request_data['password'] = bcrypt($request->password);
    //     $request_data['xray_id'] = $request->xray_id;
    //     if($request->phoneNumber[0] == '0'){
    //         $request_data['phoneNumber'] = str_replace('+','P',$request->countryCode) . substr($request->phoneNumber,1);
    //     }else{
    //         $request_data['phoneNumber'] = str_replace('+','P',$request->countryCode) . $request->phoneNumber;
    //     }
    //     $request_data['idCode'] = $request_data['phoneNumber'];
    //     // role = patient //
    //     $request_data['role'] = 'xray';
    //     $request_data['is_active'] = true;
    //     // dd($request->all());
    //     // dd($request_data['code']);
    //     /* insert data */
    //     $patienData = Patien::create($request_data);
    //     // return redirect()->route();
    //     return redirect()->back();
    // }

    /* xray branch */
    public function xray_branch($id){
        $xray = Xray::findOrFail($id);
        return view('backEnd.xray.xray_branch',compact('xray'));
    }
    /* xray branch */
    /* xray login branch */
    public function xray_login_branch($id,Request $request){
        //dd($request->all());
        $xray = Xray::findOrFail($id);
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
        return redirect()->route('Xray_getAsBranch',[$xray->id,auth()->guard('branch')->user()->id]);
    }
    /* xray login branch */
    /* xray get As branch */
    public function Xray_getAsBranch($id,$branch_id){
       $xray = Xray::findOrFail($id);
       $branch = Branch::findOrFail($branch_id);
       return view('backEnd.branch.xray_getAsBranch',compact('xray','branch'));
    }
    /* xray get As branch */

    public function homepage($id){
        try{
            $xray = Xray::findOrFail($id);
            return view('backEnd.xray.homepage',compact('xray'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'back']);
        }
    }
    public function getMywork($id){
        try{
            $xray = Xray::findOrFail($id);
            $days = Day::get();
            return view('backEnd.xray.getMywork',compact('xray','days'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function postMywork(Request $request){
        try{
            $array = [
                'xray_id' => $request->xray_id,
                'doctor_name' => $request->xrayName,
                'address'       => $request->address,
                'idCode'        => $request->idCode,
                'phoneNumber'   => $request->phoneNumber,
                'appointments'  => $request->appointments,
                'latitude'      => $request->latitude,
                'longitude'     => $request->longitude
            ];
            AppointmentLab::create($array);
            return redirect()->back();
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function orders($id){
        try{
            $xray = Xray::findOrFail($id);
            $xrayOrders = QrXray::get();
            return view('backEnd.xray.orders',compact('xray','xrayOrders'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function xrayAddPatient($id,PatienStore $request){
        try{
            $xray = Xray::findOrFail($id);
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
                $xray->poients = $xray->poients + 5;
                $xray->save();
                $clupTransction= clupTransaction::create([
                    'transaction'   => 'Add Patien',
                    'point'         => $xray->poients,
                    'balance'       =>  $xray->poients,
                    'xray_id'     => $xray->id
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
