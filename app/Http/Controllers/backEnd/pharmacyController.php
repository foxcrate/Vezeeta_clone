<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Pharmacy;
use App\models\Patien;
use App\models\Branch;
use App\Http\Requests\backEnd\pharmacy\Store;
use App\Http\Requests\backEnd\pharmacy\Update;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\verifyPharmacy;
use App\Http\Requests\backEnd\xray\StorePatien;
use App\models\Qrpharmacy;
use App\Http\Requests\backEnd\patien\Store as PatienStore;
use App\models\clupTransaction;
use Carbon\Carbon;

class pharmacyController extends Controller
{
    public function register(Request $request){
        try{
            $pharmacy = $request->session()->get('pharmacy');
            return view('backEnd.pharmacy.register',compact('pharmacy'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=> 'problem']);
        }
    }
    public function postRegister(Store $request){
        try{
            // return $request;
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
        if($request->pharmacy_License){
            $img = Image::make($request->pharmacy_License)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $request->pharmacy_License->hashName()));
            $request_data['pharmacy_License'] = asset('uploads/' . $request->pharmacy_License->hashName());
        }
        /* secure password */
        $request_data['password'] = bcrypt($request->password);
        $request_data['password_confirmation'] = bcrypt($request->password_confirmation);
        // role = patient //
        $request_data['role'] = 'pharmacy';
        if($request->phoneNumber[0] == '0'){
            $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
        }else{
             $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
        }
        $request_data['idCode'] = $request_data['phoneNumber'];
        $request_data['role'] = 'pharmacy';
        if(empty($request->session()->get('pharmacy'))){
            $pharmacy = new Pharmacy();
            $pharmacy->fill($request_data);
            $request->session()->put('pharmacy', $pharmacy);
        }else{
            $pharmacy = $request->session()->get('pharmacy');
            $pharmacy->fill($request_data);
            $request->session()->put('pharmacy', $pharmacy);
        }
        $pharmacyPhone = Pharmacy::where('phoneNumber',$request_data['phoneNumber'])->first();
        if(!$pharmacyPhone){
            return redirect()->route('pharmacy_verify');
        }
        return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);
        }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        }
    }
    /* end of function */

    /* end of function send email */
    public  function welcome($id){
        try{
            $pharmacy = Pharmacy::findOrFail($id);
            return view('backEnd.pharmacy.welcomePage',compact('pharmacy'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function verifyPharmacy($id){
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->verify = 1;
        $pharmacy->save();
        auth()->guard('pharmacy')->login($pharmacy);
        return redirect()->route('pharmacy.edit.profile',$pharmacy->id);
    }
    public function profile($id){
        $pharmacy = Pharmacy::find($id);
        return view('backEnd.pharmacy.profile',compact('pharmacy'));
    }
    /* function edit profile */
    public function editProfile($id){
        try{
            $pharmacy = Pharmacy::findOrFail($id);
            return view('backEnd.pharmacy.edit',compact('pharmacy'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* end of function */
    /* function update profile */
    public function updateProfile($id, Update $request){
        // try{
            $pharmacy = pharmacy::findOrFail($id);
            $request_data = $request->all();
            if($request->oldPhoneNumber != $request->countryCode . $request->phoneNumber){
                if($request->phoneNumber[0] == '0'){
                    $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
                }else{
                    $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
                }
                $request_data['Medical_License_Number'] = $request->Medical_License_Number;
                $setSession = $request->session()->put('updatePhoneNumber',$request_data['phoneNumber']);
                $setSessionadd = $request->session()->put('updateaddress',$request_data['address']);
                $setSessionlat = $request->session()->put('updatelatitude',$request_data['latitude']);
                $setSessionlong = $request->session()->put('updatelongitude',$request_data['longitude']);
                return redirect()->route('editPharmacyVerify',$pharmacy->id);
            }
            /* update image */
            if($request->image){
                $img = Image::make($request->image)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $request->image->hashName()));
                $request_data['image'] = asset('uploads/' . $request->image->hashName());;
            }
            if($request->pharmacy_License){
                $img = Image::make($request->pharmacy_License)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/pharmacy/' . $request->pharmacy_License->hashName()));
                $request_data['pharmacy_License'] = $request->pharmacy_License->hashName();
            }
            if($request->phoneNumber[0] == '0'){
                $request_data['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $request_data['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            /* update image */
            $request_data['Medical_License_Number'] = $request->Medical_License_Number;
            $pharmacy->update($request_data);
            return redirect()->back()->with(['msgUpdate'=>'Data Updated Successfuly']);
        // }
        // catch(\Exception $ex){
        //     return redirect()->back()->with([['error' => 'problem']]);
        // }

    }
    /* end of function */

    /* function logout */
    public function logout(){
        try{
            Auth::guard('pharmacy')->logout();
            return redirect()->route('indexRoute');
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    /* end of function */
    /* function search patient form phone number */
    public function search($id,Request $request){
        try{
            $pharmacy = Pharmacy::findOrFail($id);
            $patient = Patien::with('Raoucheh')->where('IdCode',$request->search)->first();
            if($patient){
                return view('backEnd.pharmacy.search-patient',compact('patient','pharmacy'));
            }else{
                return redirect()->back()->withErrors(['msgSearchError'=>'No Result']);
            }
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function pharmacy_add_patien(PatienStore $request,$id){
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
                $clupTransction= clupTransaction::create([
                    'transaction'   => 'Add Patien',
                    'point'         => $pharmacy->poients,
                    'balance'       =>  $pharmacy->poients,
                    'pharmacy_id'     => $pharmacy->id
                ]);
                return redirect()->back()->with(['success' => 'patient Added Successfuly']);
            }
            return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);
        }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        }
    }
    /* function search patient form phone number */
    /* labs branch */
    public function pharmacy_branch($id){
        $pharmacy = Pharmacy::findOrFail($id);
        return view('backEnd.pharmacy.pharmacy_branch',compact('pharmacy'));
    }
    /* labs branch */
    /* labs login branch */
    public function pharmacy_login_branch($id,Request $request){
        //dd($request->all());
        $pharmacy = Pharmacy::findOrFail($id);
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
        return redirect()->route('pharmacy.profile',[$pharmacy->id,auth()->guard('branch')->user()->id]);
    }
    /* labs login branch */
    /* labs get As branch */
    public function pharmacy_getAsBranch($id,$branch_id){
       $pharmacy = Pharmacy::findOrFail($id);
       $branch = Branch::findOrFail($branch_id);
       return view('backEnd.branch.pharmacy_getAsBranch',compact('pharmacy','branch'));
    }
    /* labs get As branch */
    public function homepage($id){
        try{
            $pharmacy = Pharmacy::findOrFail($id);
            return view('backEnd.pharmacy.homepage',compact('pharmacy'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'back']);
        }
    }

    public function orders($id){
        try{
            $pharmacy = Pharmacy::findOrFail($id);
            $pharmacyQr = QrPharmacy::get();
            return view('backEnd.pharmacy.orders',compact('pharmacy','pharmacyQr'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }


}
