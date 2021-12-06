<?php

namespace App\Http\Controllers\backEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backEnd\nurse\NurseStore;
use App\Http\Requests\backEnd\nurse\UpdateNurse;
use App\models\Nurse;
use App\models\Patien;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\backEnd\patien\Store as PatienStore;
use App\models\clupTransaction;
use Carbon\Carbon;

class nurseController extends Controller
{
    /* get register function */
    public function register(){
        try{
            return view('backEnd.nurse.register');
        }
        catch(\Exception $ex){
            return redirect()->back();
        }
    }
    /* end of function get register */
    public function postRegister(NurseStore $request){
        try{
            $nurseRequest = $request->all();
            if($request->image){
                $img = Image::make($request->image)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $request->image->hashName()));
                $nurseRequest['image'] = asset('uploads/' . $request->image->hashName());
            }
            // national id front image
            if($request->national_id_front_side){
                $national_id_front = Image::make($request->national_id_front_side)
                    ->resize(1280,400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/' . $request->national_id_front_side->hashName()));
                $nurseRequest['national_id_front_side'] = asset('uploads/' . $request->national_id_front_side->hashName());
            }
            // national id back image
            if($request->national_id_back_side){
                $national_id_back_side = Image::make($request->national_id_back_side)
                    ->resize(1280,400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/' . $request->national_id_back_side->hashName()));
                $nurseRequest['national_id_back_side'] = asset('uploads/' . $request->national_id_back_side->hashName());
            }
            $nurseRequest['password'] = bcrypt($request->password);
            if($request->phoneNumber[0] == '0'){
                $nurseRequest['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $nurseRequest['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            $nurseRequest['idCode'] =  $nurseRequest['phoneNumber'];
            // dd(str_replace('+','N',$nurseRequest['idCode']));
            if(empty($request->session()->get('nurese'))){
                $nurese = new Nurse();
                $nurese->fill($nurseRequest);
                $request->session()->put('nurese', $nurese);
            }else{
                $nurese = $request->session()->get('nurese');
                $nurese->fill($nurseRequest);
                $request->session()->put('nurese', $nurese);
            }
            $nursePhone = Nurse::where('phoneNumber',$nurseRequest['phoneNumber'])->first();
            if(!$nursePhone){
                return redirect()->route('nurse_verify');
            }
            return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'Phone Number Exists for another account']);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    // welcome function
    public function welcome($id){
        try{
            $nurse = Nurse::findOrFail($id);
            if(!$nurse){
                return redirect()->back()->with(['error'=>'nurse not found']);
            }
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

        return view('backEnd.nurse.welcome',compact('nurse'));
    }
    // profile function
    public function profile($id){
        $nurse = Nurse::findOrFail($id);
        if(!$nurse){
            return redirect()->back()->with(['error' => 'problem']);
        }
        return view('backEnd.nurse.profile',compact('nurse'));
    }
    // edit profile
    public function editProfile($id){
        try{
            $nurse = Nurse::findOrFail($id);
            return view('backEnd.nurse.editProfile',compact('nurse'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function updateProfile($id,UpdateNurse $request){
            // return $request;
            // try{
                $nurseRequest = $request->all();
                $nurse = Nurse::findOrFail($id);
                if($request->image){
                    $img = Image::make($request->image)
                    ->resize(1280,400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/nurse/' . $request->image->hashName()));
                    $nurseRequest['image'] = asset('uploads/nurse/' . $request->image->hashName());
                }
                if($request->phoneNumber[0] == '0'){
                    $nurseRequest['phoneNumber'] = substr($request->phoneNumber,1);
                }else{
                     $nurseRequest['phoneNumber'] = $request->phoneNumber;
                }
                $nurseRequest['idCode'] = str_replace('+','N',$request->countryCode) . $nurseRequest['phoneNumber'];
                // dd($nurseRequest);
                $nurseUpdate= $nurse->update($nurseRequest);
                return redirect()->back()->with(['success' => 'Data Updated Successfuly']);
                // }
                // catch(\Exception $ex){
                //     return redirect()->back()->with(['error' => 'problem']);
                // }
    }
    // logout
    public function logout(){
        Auth::guard('nurse')->logout();
        return redirect()->route('indexRoute');
    }
    // show profile nurse
    public function show_profile_nurse($id,$nurse_id){
        $patient = Patien::findOrFail($id);
        if(!$patient){
            return redirect()->back()->with(['error' => 'patient not found']);
        }
        $nurse = Nurse::findOrFail($nurse_id);
        if(!$nurse){
            return redirect()->back()->with(['error' => 'nurse not found']);
        }

        return view('backEnd.nurse.show_profile_nurse',compact('patient','nurse'));

    }
    // homepage function
    public function homepage($id){
        $nurse = Nurse::findOrFail($id);
        return view('backEnd.nurse.homepage',compact('nurse'));
    }
    // nurse add patient
    public function nurse_add_patien($id,PatienStore $request){
        try{
            $nurse = Nurse::findOrFail($id);
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
                $nurse->poients = $nurse->poients + 5;
                $nurse->save();
                $clupTransction= clupTransaction::create([
                    'transaction'   => 'Add Patien',
                    'point'         => $nurse->poients,
                    'balance'       =>  $nurse->poients,
                    'nurse_id'     => $nurse->id
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
