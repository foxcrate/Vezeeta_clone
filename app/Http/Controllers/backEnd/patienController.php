<?php
namespace App\Http\Controllers\backEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Patien;
use App\models\patientCar;
use App\models\patientData;
use App\models\OnlineDoctor;
use App\models\verify_patient;
use App\Http\Requests\backEnd\patien\Store;
use App\Http\Requests\backEnd\patien\StoreCheckup;
use App\Http\Requests\backEnd\patien\Update;
use App\Http\Requests\backEnd\patien\UpdatePatien;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\patienWelcome;
use App\Mail\verify_patien;
use App\models\Checkup;
use App\models\clupTransaction;
use App\models\Faviorate;
use App\models\Medication2;
use Illuminate\Support\Facades\Auth;
use App\models\Raoucheh;
use App\models\patient_analzes;
use App\models\patient_rays;
use App\models\DoctorSpecailty;
use RealRashid\SweetAlert\Facades\Alert;
use App\models\Couples;
use App\models\Rate;
use App\models\rateLab;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class patienController extends Controller
{
    public function register(Request $request){
        try{
            $patient = $request->session()->get('patient');
            return view('backEnd.patien.register',compact('patient'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with('problem');
        }
    }
    /* function register patient */

    public function postRegister(Store $request){
        try{
            // return $request;
            $request_data = $request->all();
            if($request->image){
                $hospitalRequest = $request->image;
                $image = $request->file('image');
                $input = $hospitalRequest = $image->getClientOriginalName();
                $destinationPath = public_path('uploads/');
                $image->move($destinationPath, $input);
                $request_data['image'] = asset('uploads/' . $input);

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
            $request_data['idCode'] = $request_data['phoneNumber'];
            // role = patient //
            $request_data['role'] = 'patient';
            $request_data['is_active'] = false;
            //  return $request_data;
            // dd($request->all());
            if(empty($request->session()->get('patient'))){
                $patient = new Patien();
                $patient->fill($request_data);
                $request->session()->put('patient', $patient);
            }else{
                $patient = $request->session()->get('patient');
                $patient->fill($request_data);
                $request->session()->put('patient', $patient);
            }
            /* insert data in session */
            $patientPhone = Patien::where('phoneNumber',$request_data['phoneNumber'])->first();
            if(!$patientPhone){
                return redirect()->route('patient_verify');
            }
            return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'Phone Number Exists for another account']);
        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }
    }
    public  function welcome($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.welcomePage',compact('patient'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    /* end of function */
    /* function edit data profile */
    public function edit_data_profile($id){
        try{
            $patient = Patien::with('patinets_data')->findOrFail($id);
            $medications = Medication2::all();
            //return $medications;
            if($patient){
                return view('backEnd.patien.edit_data_profile',compact('patient','medications'));
                // return $patient->patinets_data->agree_name;
            }
            return redirect()->back();
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    /* end of function */
    public function update_data_profile(Request $request , $id,$profile_id){
        $patient = Patien::findOrFail($id);
        $patienData = patientData::findOrFail($profile_id);
        /* insert all request */
        $requestData = $request->all();
        /* check allergi name of count > 0 */
        $data2 = [
            'width'                 => $request->width,
            'height'                => $request->height,
            'width_type'            => $request->width_type,
            'blood'                 => $request->blood,
            'agree_name'            => $request->agree_name,
            'allergi_data'          => $request->allergi_data,
            'surgery_data'          => $request->surgery_data,
            'medication_name' => $request->medication_name,
            'colonscopy'      => $request->colonscopy,
            'colonscopy_data'=> $request->colonscopy_data,
            'mammogram'     => $request->mammogram,
            'mammogram_data'=> $request->mammogram_data,
            'prc'           => $request->prc,
            'prc_data'      => $request->prc_data,
            'smoking'              => $request->smoking,
            'mother'            => $request->mother,
            'other_mother'      => $request->other_mother,
            'father'            => $request->father,
            'other_father'      => $request->other_father,
            'wife_Period_Cycle' => $request->wife_Period_Cycle,
            'wife_Abotion'      => $request->wife_Abotion,
            'wife_Contraceptive'    => $request->wife_Contraceptive,
            'mother_Period_Cycle'   => $request->mother_Period_Cycle,
            'mother_pregnency'      => $request->mother_pregnency,
            'mother_abotion'        => $request->mother_abotion,
            'mother_deliveries'     => $request->mother_deliveries,
            'mother_complicetion'   => $request->mother_complicetion,
            'mother_Contraceptive'  => $request->mother_Contraceptive,
            'patient_id'              =>$request->patient_id,
            'single_Period_Cycle'      => $request->single_Period_Cycle,
        ];
        if($rocata_file=$request->file('rocata_file')){
            $dummy = $patienData->rocata_file;
            foreach($rocata_file as $ro){
                $rocata_name= time().'.'.$ro->getClientOriginalName();
                $ro->move('uploads/pdf_file/',$rocata_name);
                $rocata= asset('uploads/pdf_file/' . $rocata_name);
                $multiple[]=$rocata;
            }
            if (is_array($dummy)) {
                foreach($multiple as $multi){
                    $s=array_push($dummy,$multi);
                    //  $data2['rocata_file'] = $dummy;
                }
                $data2['rocata_file'] = $dummy;
            }else{
                $dummy=[];
                $dummy=array_push($dummy,$multiple);
                $data2['rocata_file'] = $multiple;
            }
        }
        if($rays_file = $request->file('rays_file')){
            $dummy1 = $patienData->rays_file;
            foreach($rays_file as $ray){
                $rays_name = str_replace(' ','',rand(100000,999999).$ray->getClientOriginalName());
                $ray->move('uploads/pdf_file/',$rays_name);
                $rays= asset('uploads/pdf_file/' . $rays_name);
                $multiple1[]=$rays;
            }
            if (is_array($dummy1)) {
                foreach($multiple1 as $multi){
                    $s=array_push($dummy1,$multi);
                    //  $data2['rocata_file'] = $dummy;
                }
                $data2['rays_file'] = $dummy1;
            }else{
                $dummy1=[];
                $dummy=array_push($dummy1,$multiple1);
                $data2['rays_file'] = $multiple1;

            }
        }
        if($analzes_file = $request->file('analzes_file')){
            $dummy2 = $patienData->analzes_file;
            foreach($analzes_file as $ana){
                $analzes_name =str_replace(' ','',rand(100000,999999).$ana->getClientOriginalName());
                $ana->move('uploads/pdf_file/',$analzes_name);
                $analzes = asset('uploads/pdf_file/' . $analzes_name);
                $multiple2[]=$analzes;
                // return $mult;
            }
            if (is_array($dummy2)) {
                foreach($multiple2 as $multi){
                    $s=array_push($dummy2,$multi);
                    //  $data2['rocata_file'] = $dummy;
                }
                $data2['analzes_file'] = $dummy2;
            }else{
                $dummy2=[];
                $dummy2=array_push($dummy2,$multiple2);
                $data2['analzes_file'] = $multiple2;
            }
        }

        /* create data in table patient Data */

        // $data2['online'] = 1;
        $patienData->update($data2);
        alert::image('','','https://phistory.life/public/imgs/alert/done.png');
        return redirect()->route("patien-profile",$data2['patient_id']);

        // catch(\Exception $ex){
        Alert::error('Error', 'Problem');
        return redirect()->back();
    }
    /* function send email */
    public function sendEmail($id){
        $patient = Patien::findOrFail($id);
        Mail::to($patient->email)->send(new verify_patien($patient));
        return redirect()->back()->with(['EmailMsg'=>'Check Your Email']);
    }
    /* end of function send email */
    /* function verify email */
    public function verifyPatient($id){
        $patient = Patien::findOrFail($id);
        $patient->verify = 1;
        $patient->save();
        auth()->guard('patien')->login($patient);
        return redirect()->route('edit.profile',$patient->id);
    }
    /* function verify email */
    public function profile($id){
        try{
            $patient = Patien::with('patinets_data')->findOrFail($id);
            // dd($patient->with('patinets_data'));
            return view('backEnd.patien.profile',compact('patient'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    /* edit profile function */
    public function editProfile($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.edit-profile',compact('patient'));
        }
        catch(\Exception $ex){
            Alert::error('Error', 'Problem');
            return redirect()->back();
        }
        // return dd(Patien::find(1)->first()->agrees());
    }
    /* end of function */
    public function download_pdf($type,$id){
        $patient = Patien::findOrFail($id);
        if($type == 'rocata'){
            foreach($patient->patinets_data->rocata_file as $ro){
                return Response::download(public_path('uploads/pdf_file/' . str_replace('https://localhost/Phistory/public/uploads/pdf_file/','',$ro)));
            }
        }elseif($type == 'test'){
            foreach($patient->patinets_data->analzes_file as $ro){
                return Response::download(public_path('uploads/pdf_file/' . str_replace('https://localhost/Phistory/public/uploads/pdf_file/','',$ro)));
            }
        }else{
            foreach($patient->patinets_data->rays_file as $ro){
                return Response::download(public_path('uploads/pdf_file/' . str_replace('https://localhost/Phistory/public/uploads/pdf_file/','',$ro)));
            }
        }

    }

    public function add(){
        return User::all();
    }
    public function deleteFiles($type,$id){
        $patient = Patien::findOrFail($id);
        $myar = $patient->patinets_data->rocata_file;
        $test = $patient->patinets_data->analzes_file;
        $ray = $patient->patinets_data->rays_file;
        if($type == 'rocata'){
            foreach($myar as $index => $value){
                unset($myar[$index]);
                $patient->patinets_data->rocata_file = $myar;
                $patient->patinets_data->save();
                alert::image('','','https://phistory.life/Phistory/public/imgs/alert/done.png');
//                alert('success','Prescription deleted success');
                return redirect()->back();
            }
        }elseif($type == 'test'){
            foreach($test as $key => $ro){
                unset($test[$key]);
                $patient->patinets_data->analzes_file = $test;
                $patient->patinets_data->save();
                alert::image('','','https://phistory.life/Phistory/public/imgs/alert/done.png');
                return redirect()->back();
            }
        }else{
            foreach($ray as $key => $ro){
                unset($ray[$key]);
                $patient->patinets_data->rays_file = $ray;
                $patient->patinets_data->save();
                alert::image('','','https://phistory.life/Phistory/public/imgs/alert/Don1e.png');
                return redirect()->back();
            }
        }
    }
    /* compleate profile function */
    public function updateProfile($id,Request $request){
        // return $request;
        Alert::success('Success', 'Updated Profile Successfuly');
        $patient = Patien::findOrFail($id);
        /* insert all request */
        $requestData = $request->all();
        $data2 = [
            'width'                 => $request->width,
            'height'                => $request->height,
            'width_type'            => $request->width_type,
            'blood'                 => $request->blood,
            'agree_name'            => $request->agree_name,
            'allergi_data'          => $request->allergi_data,
            'surgery_data'          => $request->surgery_data,
            'medication_name' => $request->medication_name,
            'colonscopy'      => $request->colonscopy,
            'colonscopy_data'=> $request->colonscopy_data,
            'mammogram'     => $request->mammogram,
            'mammogram_data'=> $request->mammogram_data,
            'prc'           => $request->prc,
            'prc_data'      => $request->prc_data,
            'smoking'       => $request->smoking,
            'mother'            => $request->mother,
            'other_mother'      => $request->other_mother,
            'father'            => $request->father,
            'other_father'      => $request->other_father,
            'wife_Period_Cycle' => $request->wife_Period_Cycle,
            'wife_Abotion'      => $request->wife_Abotion,
            'wife_Contraceptive'    => $request->wife_Contraceptive,
            'mother_Period_Cycle'   => $request->mother_Period_Cycle,
            'mother_pregnency'      => $request->mother_pregnency,
            'mother_abotion'        => $request->mother_abotion,
            'mother_deliveries'     => $request->mother_deliveries,
            'mother_complicetion'   => $request->mother_complicetion,
            'mother_Contraceptive'  => $request->mother_Contraceptive,
            'patient_id'              =>$request->patient_id,
            'single_Period_Cycle'      => $request->single_Period_Cycle,
        ];
        if($rocata_file=$request->file('rocata_file')){
            foreach($rocata_file as $ro){
                $rocata_name= str_replace(' ','',rand(100000,999999).$ro->getClientOriginalName());
                $ro->move('uploads/pdf_file/',$rocata_name);
                $rocata[]=asset('uploads/pdf_file/' . $rocata_name);
                $data2['rocata_file'] = $rocata;
            }


        }
        if($rays_file = $request->file('rays_file')){
            foreach($rays_file as $ray){
                $rays_name = str_replace(' ','',rand(100000,999999).$ray->getClientOriginalName());
                $ray->move('uploads/pdf_file/' , $rays_name);
                $rays[]=asset('uploads/pdf_file/' . $rays_name);
                $data2['rays_file'] = $rays;
            }


        };
        if($analzes_file = $request->file('analzes_file')){
            foreach($analzes_file as $ana){
                $analzes_name = str_replace(' ','',rand(100000,999999).$ana->getClientOriginalName());
                $ana->move('uploads/pdf_file/' , $analzes_name);
                $analzes[] = asset('uploads/pdf_file/' . $analzes_name);
                $data2['analzes_file'] = $analzes;
            }
        };

        $patienCreate = patientData::create($data2);
        return redirect()->route('patien-profile',$data2['patient_id']);


        // catch(\Exception $ex){
        //     Alert::error('Error', 'Problem');
        //     return redirect()->back();
        // }
        //return $request;
        /* patient find by id */

        //dd($request->all());
    }
    /* end of function */
    /* function edit data profile */
    public function editData($id){
        $patient = Patien::findOrFail($id);
        return view('backEnd.patien.editData',compact('patient'));
    }
    /* end of function */
    /* function update basic data UpdatePatien */
    public function updateData($id,UpdatePatien $request){
        try{
            // return $request;
            $requestData = $request->all();
            $patient = Patien::findOrFail($id);
            // return $request->phoneNumber;
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
                return redirect()->route('editVerify',$patient->id);
                // dd(session()->get('updatePhoneNumber'));
            }
            if($request->image){
                $img = Image::make($request->image)
                    ->resize(1280,400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/' . $request->image->hashName()));
                $requestData['image'] = asset('uploads/' . $request->image->hashName());
            }
            if($request->phoneNumber[0] == '0'){
                $requestData['phoneNumber'] = $request->countryCode . substr($request->phoneNumber,1);
            }else{
                $requestData['phoneNumber'] = $request->countryCode . $request->phoneNumber;
            }
            $requestData['address'] = $request->address;
            $requestData['latitude'] = $request->latitude;
            $requestData['longitude'] = $request->longitude;
            // $requestData['BirthDate'] = (new Carbon($request->BirthDate))->timestamp;
            // return $requestData;
            $patient->update($requestData);
            alert()->html("<img width=150 src='https://phistory.life/Phistory/public/imgs/alert/Don1e.png'>",false);
            return redirect()->route('patien.homepage',$patient->id);
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }
    /* end of function */
    /* function logout patient */
    public function logout(){
        Auth::guard('patien')->logout();

        Session::forget('loggedID');
        Session::forget('loggedType');

        return redirect()->route('indexRoute');
    }
    /* end of function */

    public function verfi(){
        return view('backEnd.layoutes.verficationCode');
    }

    public function getOldpescription($id){
        try{
            $patient = Patien::with(['Raoucheh','patient_analzes','patient_rays'])->where('idCode',$id)->first();
            return view('backEnd.patien.old_pescription',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
        // return $patient->Raoucheh;
    }

    public function notifyRocata($id){
        try{
            $patient = Patien::with(['Raoucheh'])->findOrFail($id);
            return view('backEnd.patien.notifacation.getRocata',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function notifyTest($id){
        try{
            $patient = Patien::with(['patient_analzes'])->findOrFail($id);
            return view('backEnd.patien.notifacation.getTest',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function notifyRay($id){
        try{
            $patient = Patien::with('patient_rays')->findOrFail($id);
            return view('backEnd.patien.notifacation.getRay',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function readNotify(){
        try{
            auth('patien')->user()->unreadNotifications->markAsRead();
            return redirect()-> back();
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function homepage($id){
        try{
            //return
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.homepage',compact('patient'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    /* get All favorite */
    public function getfavorite($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.getfavorite',compact('patient'));
        }
        catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back();
        }
    }
    /* get All favorite */
    /* get favoraite where type */
    public function getfavoriteType($id,$type){
        try{
            $patient = Patien::findOrFail($id);
            if($type == 'doctor'){
                $fav = Faviorate::where('type','doctor')
                    ->where('patient_id',$patient->id)
                    ->get();
            }elseif($type == 'nurse'){
                $fav = Faviorate::where('type','nurse')
                    ->where('patient_id',$patient->id)
                    ->get();
            }elseif($type == 'pharmacy'){
                $fav = Faviorate::where('type','pharmacy')
                    ->where('patient_id',$patient->id)
                    ->get();
            }elseif($type == 'xray'){
                $fav = Faviorate::where('type','xray')
                    ->where('patient_id',$patient->id)
                    ->get();
            }elseif($type == 'lab'){
                $fav = Faviorate::where('type','lab')
                    ->where('patient_id',$patient->id)
                    ->get();
            }
            return view('backEnd.patien.favorite.type',compact('patient','fav'));
        }
        catch(\Exception $ex){
            Alert::success('Error', 'problem');
            return redirect()->back();
        }
    }
    /* get favoraite where type */

    /* postcheckup function */
    public function Postcheckup(StoreCheckup $request){
        try{
            Alert::success('Create Checkup', 'Checkup created success');
            $checupRequest = $request->all();
            $checkups = Checkup::create([
                'temperature'       => $request->temperature,
                'blood_pressure'    => $request->blood_pressure,
                'diabetics'         => $request->diabetics,
                'date'              => now()->timestamp,
                'oxygen'            => $request->oxygen,
                'patient_id'        => $request->patient_id
            ]);
            // $checupCreate = Checkup::create($checupRequest);
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back();
        }
    }
    /* postcheckup function */
    public function getCheckup($id){
        try{
            $patient = Patien::findOrFail($id);
            $checkups = Checkup::orderBy('id','desc')->where('patient_id',$patient->id)->get();
            return view('backEnd.patien.getCheckup',compact('patient','checkups'));
        }
        catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back();
        }
    }

    /* homecare functions */
    public function index($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.homecare.index',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function patientCars($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.homecare.patientCars',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function postPatientCars($id,Request $request){
        try{
            Alert::success('Success Message','Success Added');
            // return $request;
            $patient = Patien::findOrFail($id);
            $patienCarsCreate = patientCar::create([
                'ampulanceType' => $request->ampulanceType,
                'patientName'   => $request->name,
                'phoneNumber'   => $request->phoneNumber,
                'date'          => $request->date,
                'address'       => $request->address,
                'addressDist'   => $request->addressDist,
                'carType'       => $request->carType,
                'PurposeOfTheTipe'  => $request->PurposeOfTheTipe,
                'requireQues'       => $request->requireQues,
                'patient_id'        => $patient->id
            ]);
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }
    public function getHomecare($id){
        try{
            $doctorSp = DoctorSpecailty::with('onlineDoctor')->get();
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.homecare.getHomecare',compact('patient','doctorSp'));
        }
        catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back();
        }
    }

    public function showDoctorsHomecare($id,$special_id){
        try{
            $patient = Patien::find($id);
            $spdoctors = DoctorSpecailty::with('onlineDoctor')->find($special_id);
            return view("backEnd.patien.homecare.showDoctors",compact('spdoctors','patient'));
        }
        catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back(['error' => 'problem']);
        }
    }

    public function homecare_show_profile_doctor($id,$doctor_id){
        try{
            $patient = Patien::find($id);
            $online_doctor = OnlineDoctor::find($doctor_id);
            return view("backEnd.patien.homecare.show_profile_doctor",compact('patient','online_doctor'));
        }
        catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back();
        }
    }

    /* homecare functions */

    /* patient_update_online function */
    public function patient_update_online(Request $request,$id){
        try{
            Alert::success('Success', 'Updated Online');
            $patient = Patien::findOrFail($id);
            if($request->has('online'))
                $request->request->add(['online' => 1]);
            else
                $request->request->add(['online' => 0]);
            $patient->update($request->all());
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error', 'problem');
            return redirect()->back();
        }
    }
    /* patient_update_online function */

    public function patient_Appointments($id){
        $patient = Patien::findOrFail($id);
        return view('backEnd.patien.patient_Appointments',compact('patient'));
    }
    public function searchWife($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.wife.searchWife',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function getWife(Request $request){
        try{
            $patientSearch = Patien::where('idCode',$request->idCodeWife)->whereNotIn('idCode',[auth()->guard('patien')->user()->idCode])->first();
            if($patientSearch){
                return redirect()->back()->with(['data' => $patientSearch]);
            }
            Alert::error('Error','Not found');
            return redirect()->back();
        }catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function addRequestWife($id,Request $request){
        try{
            Alert::success('Success', 'Request Added successfuly');
            $user = auth('patien')->user()->id;
            $CouplesCreate = Couples::create([
                'patientAccept_id'  => $request->patientAcceptId,
                'patientRequest_id'  => $request->patientRequestId,
                'couples'   => false,
            ]);
            // $user->notify(new \App\Notifications\addRequestWife($CouplesCreate['patientAccept_id'],$CouplesCreate['patientRequest_id']));
            return redirect()->back();
        }catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function acceptRequestWife(Request $request){
        try{
            Alert::success('Success','Couples updated Successfualy');
            $couples = Couples::findOrFail($request->request_id);
            $couples->couples = true;
            $couples->save();
            return redirect()->back();
        }catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function declineRequestWife(Request $request){
        try{
            Alert::success('Success','Couples Decline Successfuly');
            $couples = Couples::findOrFail($request->request_id);
            $couples->delete();
            return redirect()->back();
        }catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }
    public function addRateDoctor(Request $request){
        try{
            $rateCreate = Rate::create([
                'doctorRate'    => $request->rating,
                'receiption'    => $request->receiption,
                'price'         => $request->price,
                'cleanliness'   => $request->cleanliness,
                'nursing'       => $request->nursing,
                'servicing'     => $request->servicing,
                'patient_id'    => $request->patient_id,
                'doctor_id'     => $request->doctor_id
            ]);
            return redirect()->back();
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function addRateXray(Request $request){
        try{
            $rateCreate = rateLab::create([
                'rate'    => $request->rating,
                'receiption'    => $request->receiption,
                'price'         => $request->price,
                'cleanliness'   => $request->cleanliness,
                'nursing'       => $request->nursing,
                'servicing'     => $request->servicing,
                'patient_id'    => $request->patient_id,
                'xray_id'       => $request->doctor_id
            ]);
            return redirect()->back();
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function getReport($id){
        try{
            $patient = Patien::with(['patinets_data'])->findOrFail($id);
            $lastCheckup = Checkup::where('patient_id',$id)->orderBy('id','DESC')->first();
            return view('backEnd.patien.getReport',compact('patient','lastCheckup'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function showReportAccept($id){
        $patient = Patien::with(['patinets_data'])->findOrFail($id);
        $lastCheckup = Checkup::where('patient_id',$id)->orderBy('id','DESC')->first();
        return view('backEnd.patien.showReportAccept',compact('patient','lastCheckup'));
    }

    public function addNew_wifeOrHusband(Request $request){
        // try{
        $request_data = $request->all();
        // return $request_data;
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
        $request_data['idCode'] = str_replace('+','P', $request_data['phoneNumber']);
        $request_data['BirthDate'] = (new Carbon($request->BirthDate))->timestamp;
        // role = patient //
        $request_data['role'] = 'patient';
        $request_data['is_active'] = false;
        $patientPhone = Patien::where('phoneNumber',$request_data['phoneNumber'])->first();
        if(!$patientPhone){
            $patientCreate = Patien::create($request_data);
            $patienData = patientData::create([
                'width' => null,
                'height'    => null,
                'blood' => null ,
                'patient_id' => $patientCreate['id'],
            ]);
            $couples = Couples::create([
                'patientAccept_id' => $patientCreate['id'],
                'patientRequest_id' => auth('patien')->user()->id,
                'couples'       => 1
            ]);
            Alert::success('success','patient addedd succesfuly');
            return redirect()->back();
        }
        return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);

        // }catch(\Exception $ex){
        //     Alert::error('error','problem');
        // }

    }

    public function efelate_post_Register(Request $request,$id){
        $efelate = Patien::findOrFail($id);
        try{
            // return $request;
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
            $request_data['idCode'] = $request_data['phoneNumber'];
            // role = patient //
            $request_data['role'] = 'patient';
            $request_data['is_active'] = false;
            //  return $request_data;
            // dd($request->all());
            if(empty($request->session()->get('patient'))){
                $patient = new Patien();
                $patient->fill($request_data);
                $request->session()->put('patient', $patient);
            }else{
                $patient = $request->session()->get('patient');
                $patient->fill($request_data);
                $request->session()->put('patient', $patient);
            }
            /* insert data in session */
            $patientPhone = Patien::where('phoneNumber',$request_data['phoneNumber'])->first();
            if(!$patientPhone){
                $efelate->poients = $efelate->poients + 5;
                $efelate->save();
                $clupTransctionCreate = clupTransaction::create([
                    'transaction'  => 'Invite Patient',
                    'point'        => 5,
                    'balance'      => $efelate->poients,
                    'patient_id'   => $efelate->id,
                ]);
                return redirect()->route('patient_verify');
            }
            return redirect()->back()->withInput($request->input())->with(['phoneMsg'=> 'phoneNumber is Exists!']);
        }
        catch(\Exception $e){
            return back()->withInput($request->input())->with(['verifyMsg'=>'This PhoneNumber Is Exist  !']);
        }
    }
}
