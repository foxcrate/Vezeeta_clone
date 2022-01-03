<?php

namespace App\Http\Controllers\backEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backEnd\DoctorSucduleRequest;
use App\models\Appointment;
use App\models\AppointmentLab;
use App\models\Clinic;
use App\models\DoctorScudule;
use App\models\DoctorSpecailty;
use App\models\Faviorate;
use App\models\Finder;
use App\models\Hosptail;
use App\models\Lab;
use App\models\Nurse;
use App\models\OnlineDoctor;
use App\models\Patien;
use App\models\Pharmacy;
use App\models\testScudule;
use App\models\Xray;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
class finderController extends Controller
{
    public function getPharmacy($id){
        $patient = Patien::findOrFail($id);
        $pharmacies = Pharmacy::where('role','pharmacy')->get();
        return view('anyPages.finder_pharmacy',compact('pharmacies','patient'));
    }
    public function getXray($id){
        try{
            $patient = Patien::findOrFail($id);
            $xray = AppointmentLab::where('lab_id',null)->get();
            return view('anyPages.finder_xray',compact('xray','patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function getLab($id){
        try{
            $patient = Patien::findOrFail($id);
            $labs = AppointmentLab::where('xray_id',null)->get();
            return view('anyPages.finder_lab',compact('labs','patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function getDoctor($id){
        $patient = Patien::findOrFail($id);
        $doctors = OnlineDoctor::get();
        $specials = DoctorSpecailty::get();
        return view('anyPages.finder_doctor',compact('doctors','patient','specials'));
    }
    public function getNurse($id){
        $patient = Patien::findOrFail($id);
        $nurses = Nurse::get();
        return view('anyPages.finder_nurse',compact('nurses','patient'));
    }

    public function add_to_faviorate_nurse(Request $request){
        //return $request;
        try{
            Alert::success('Success','Success Faviorate');
            $patient = Patien::findOrFail($request->patient_id);
            $nurse = Nurse::findOrFail($request->nurse_id);
            $favCreate = Faviorate::create([
                'name'          => $nurse->name,
                'idCode'        => $nurse->idCode,
                'address'       => $nurse->address,
                'latitude'      => $nurse->latitude,
                'longitude'     => $nurse->longitude,
                'type'          => 'nurse',
                'patient_id'    => $patient->id,
                'nurse_id'     => $nurse->id,
            ]);
            $nurse->is_faviorate = true;
            $nurse->save();
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error' , 'Problem');
            return redirect()->back();
        }

        // return response()->json([
        //     'data'  => $favCreate,
        //     'status'    => true
        // ]);

    }
    // public function dd(Request $request){
    //     return $request;
    // }
    public function add_to_faviorate_doctor(Request $request){
        //return $request;
        try{
            Alert::success('Success','Success Faviorate');
            $patient = Patien::findOrFail($request->patient_id);
            $doctor = OnlineDoctor::findOrFail($request->doctor_id);
            $favCreate = Faviorate::create([
                'name'          => $doctor->name,
                'idCode'        => $doctor->idCode,
                'address'       => $doctor->address,
                'latitude'      => $doctor->latitude,
                'longitude'     => $doctor->longitude,
                'type'          => 'doctor',
                'patient_id'    => $patient->id,
                'doctor_id'     => $doctor->id
            ]);
            // $doctor->is_faviorate = true;
            $doctor->save();
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }
    public function add_to_faviorate_pharmacy(Request $request){
        // return $request;
        try{
            Alert::success('Success','Success Faviorate');
            $patient = Patien::findOrFail($request->patient_id);
            $pharmacy = Pharmacy::findOrFail($request->pharmacy_id);
            $favCreate = Faviorate::create([
                'name'          => $pharmacy->pharmacyName,
                'idCode'        => $pharmacy->idCode,
                'address'       => $pharmacy->address,
                'latitude'      => $pharmacy->latitude,
                'longitude'     => $pharmacy->longitude,
                'type'          => 'pharmacy',
                'patient_id'    => $patient->id,
                'pharmacy_id'     => $pharmacy->id
            ]);
            $pharmacy->is_faviorate = true;
            $pharmacy->save();
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }
    public function add_to_faviorate_xray(Request $request){
        // return $request;
        try{
            Alert::success('Success','Success Faviorate');
            $patient = Patien::findOrFail($request->patient_id);
            $xray = Xray::findOrFail($request->xray_id);
            $favCreate = Faviorate::create([
                'name'          => $xray->xrayName,
                'idCode'        => $xray->idCode,
                'address'       => $xray->address,
                'latitude'      => $xray->latitude,
                'longitude'     => $xray->longitude,
                'type'          => 'xray',
                'patient_id'    => $patient->id,
                'xray_id'     => $xray->id
            ]);
            $xray->is_faviorate = true;
            $xray->save();
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

        // return response()->json([
        //     'data'  => $favCreate,
        //     'status'    => true
        // ]);
    }
    public function add_to_faviorate_lab(Request $request){
        // return $request;
        try{
            Alert::success('Success','Success Faviorate');
            $patient = Patien::findOrFail($request->patient_id);
            $lab = Lab::findOrFail($request->lab_id);
            $favCreate = Faviorate::create([
                'name'          => $lab->labsName,
                'idCode'        => $lab->idCode,
                'address'       => $lab->address,
                'latitude'      => $lab->latitude,
                'longitude'     => $lab->longitude,
                'type'          => 'lab',
                'patient_id'    => $patient->id,
                'lab_id'        => $lab->id
            ]);
            $lab->is_faviorate = true;
            $lab->save();
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
        // return response()->json([
        //     'data'  => $favCreate,
        //     'status'    => true
        // ]);
    }

    public function get_appointments($id,$docotr_id){
        //return $docotr_id ;
        try{
            $patient = Patien::findOrFail($id);
            $doctor = Appointment::findOrFail($docotr_id);
            //return $doctor;
            // $doctor = Appointment::where('doctor_id',$docotr_id);
            // return $doctor;
            //return $doctor->appointments;
            return view('backEnd.online-doctor.get_appointments',compact('patient','doctor'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
        }
    }

    public function search_doctor($id,Request $request){
        try{
            //return $request;
            $patient = Patien::findOrFail($id);
            $doctors = Appointment::where('doctor_name','LIKE', '%' . $request->search . '%')
            ->orWhere('special','LIKE','%' . $request->search . '%')->count();
            //return $doctors;
            if($doctors){
                $doctors = Appointment::where('doctor_name','LIKE','%' . $request->search . '%')
                ->orWhere('special','LIKE','%' . $request->search . '%')->get();
                return view('anyPages.get_doctors',compact('patient','doctors'));
            }
            Alert::error('Error','Not Found');
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

    }

    public function book(DoctorSucduleRequest $request,$id,$doctor_id){
        //return $request;
        try{
            Alert::success('Success','Sucess Message');
            $patient = Patien::findOrFail($id);
            $doctor = Appointment::findOrFail($doctor_id);
            $bookRequest = $request->all();

            //$repeated_schedule = false;
            $repeated_schedule = testScudule::where('appoiment_id',$doctor_id)->where('patient_id',$id)->where('day_name',$request->appointmentsD)->where('from',$request->appointmentsF)->with('appoiment')->get();
            //return $repeated_schedule->count();

            if( $repeated_schedule->count() != 0 ){
                Alert::error('Error','You have already booked with this doctor at this time');
                return redirect()->back();
            }

            $doc_sucdule = testScudule::create([
                'patient_id'    => $request->patient_id,
                'patient_name' => $request->patient_name,
                'patient_phone' => $request->patient_phone,
                'day_name'      => $request->appointmentsD,
                'from'          => $request->appointmentsF,
                'to'            => $request->appointmentsT,
                'time'          => $request->appointmentsF . ' ' . $request->appointmentsT,
                'appoiment_id'  => $request->appoiment_id
            ]);
            if($doc_sucdule){
                return redirect()->route('finder.show.book',['id'=>$patient->id,'doctor_id'=>$doctor_id,'scudle_id'=>$doc_sucdule['id']]);
            }

        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function show_book($id,$doctor_id,$doc_sucdule_id){
        try{
            //return "Alo";
            $patient = Patien::findOrFail($id);
            $doctor = Appointment::findOrFail($doctor_id);
            $doc_sucdule = testScudule::findOrFail($doc_sucdule_id);
            return view('anyPages.ShowBook',compact('patient','doctor','doc_sucdule'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function update_book(Request $request,$id,$doctor_id,$doc_sucdule_id){
        try{
            Alert::success('Success','Sucess Confirmed');
            $patient = Patien::findOrFail($id);
            $doctor = Appointment::findOrFail($doctor_id);
            $doc_sucdulee = testScudule::findOrFail($doc_sucdule_id);
            // $doc_sucdule->update($request->except(['Hpatient_name','Hpatient_phone']));
            $bookRequest = $request->all();
            $doc_sucdule = DoctorScudule::create([
                'patient_id'    => $request->id,
                'patient_name' => $request->patient_name,
                'patient_phone' => $request->patient_phone,
                'day_name'      => $doc_sucdulee->day_name,
                'from'          => $doc_sucdulee->from,
                'to'            => $doc_sucdulee->to,
                'time'          => $doc_sucdulee->from . ' ' . $doc_sucdulee->to,
                'appoiment_id'  => $doc_sucdulee->appoiment_id
            ]);
            $doc_sucdulee->patient_name = $request->Hpatient_name;
            $doc_sucdulee->patient_phone = $request->Hpatient_phone;
            $doc_sucdulee->save();
            return redirect()->route('patien.homepage',$id)->with('message','Appointment Confirmed Successfully');
        }
        catch(\Exception $ex){
            Alert::error('Error',$ex->getMessage());
            return redirect()->back();
        }
    }

    public function searchDoctorInClinic($id,Request $request){
        try{
            $patient = Patien::findOrFail($id);
            $clinic = Clinic::with(['clinicDoctorAppoiemnts'])->where('clinicName',$request->clinicName)->first();
            if(!$clinic){
                Alert::error(['Clinic Not Found']);
                return redirect()->back();
            }
            return view('anyPages.getDoctorInClinic',compact('patient','clinic'));
        }catch(\Exception $ex){
            Alert::error('Error Message','Problem');
            return redirect()->back();
        }


    }

    public function searchDoctorInHosptail($id,Request $request){
        try{
            $patient = Patien::findOrFail($id);
            $hosptail = Hosptail::with(['hosptailDoctorAppoiemnts'])->where('hosptailName',$request->hosptailName)->first();
            if(!$hosptail){
                Alert::error(['Hosptail Not Found']);
                return redirect()->back();
            }
            return view('anyPages.getDoctorInHosptail',compact('patient','hosptail'));
        }catch(\Exception $ex){
            Alert::error('Error','problem');
            return redirect()->back();
        }
    }



}
