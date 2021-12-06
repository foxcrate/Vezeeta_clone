<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backEnd\donateStore;
use App\Http\Requests\backEnd\patien\donate\addMedication;
use App\Http\Requests\backEnd\patien\donate\addMedical;
use App\models\Blood;
use App\models\DeviceRequest;
use App\models\Donor;
use App\models\medicalDevices;
use App\models\Medication;
use App\models\medicationRequest;
use App\models\Patien;
use App\models\needDonor;
use App\models\requestDonor;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
class donateController extends Controller
{
    public function index($id){
        try{
            $bloods = Blood::get(['name']);
            $patient = Patien::findOrFail($id);
            $donors= Donor::get();
            $medications = Medication::get();
            $medicalDevices = medicalDevices::get();
            return view('backEnd.patien.donate.index',compact('patient','donors','medications','medicalDevices','bloods'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function patient_update_is_donor(Request $request,$id){
        try{
            DB::beginTransaction();
            Alert::success('Success Message','Updated Success');
            $patient = Patien::findOrFail($id);
            if($request->has('is_donor')){
                if($patient->age >= 18){
                    $request->request->add(['is_donor' => 1]);
                    $patient->is_donor = $request->is_donor;
                    $patient->save();
                    $donorCreate = Donor::create([
                        'patient_id' => $patient->id,
                        'blood'     => $patient->patinets_data->blood,
                        'latitude'  => $request->latitude,
                        'longitude' => $request->longitude
                    ]);
                }
            }else{
                $request->request->add(['is_donor' => 0]);
                $patient->is_donor = false;
                $patient->save();
                Donor::where('patient_id', $patient->id)->delete();
            }
            DB::commit();
            return redirect()->route('donate.index',$patient->id);
        }
        catch(\Exception $ex){
            DB::rollback();
            Alert::error('Error','Problem');
            return redirect()->back();
        }

    }

    public function addMediction(addMedication $request,$id){
        try{
            Alert::success('Message Sucees','Medication added Sucessfuly');
            $patient = Patien::findOrFail($id);
            $medicationAll = $request->all();
            if($request->medicationImage){
                $img = Image::make($request->medicationImage)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $request->medicationImage->hashName()));
                $medicationAll['medicationImage'] = asset('uploads/' . $request->medicationImage->hashName());
            }
            $medicationAll['patient_id'] = $patient->id;
            $medicationCreate = Medication::create($medicationAll);
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }
    public function addMedicalDevices(addMedical $request,$id){
        try{
            Alert::success('Message Sucees','MedicalDevices added Sucessfuly');
            $patient = Patien::findOrFail($id);
            $MedicalDevicesAll = $request->all();
            if($request->medicalDevicesImage){
                $img = Image::make($request->medicalDevicesImage)
                ->resize(1280,400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/' . $request->medicalDevicesImage->hashName()));
                $MedicalDevicesAll['medicalDevicesImage'] = asset('uploads/'.  $request->medicalDevicesImage->hashName());
            }
            $MedicalDevicesAll['patient_id'] = $patient->id;
            $MedicalDevicesCreate = medicalDevices::create($MedicalDevicesAll);
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function donateStore(donateStore $request){
        try{
            Alert::success('Success Message','Need Donor Added Successfuly');
            $needDonor = needDonor::create([
                'patient_id'    => $request->patient_id,
                'latitude'      => $request->latitude,
                'longitude'     => $request->longitude,
                'blood'         => $request->blood,
                'address'       => $request->address,
                'details'       => $request->details,
                'patientName'   => $request->patientName,
                'fileName'      => $request->fileNumber
            ]);
            $searchDonor = Donor::where('blood',$needDonor['blood'])->get();
            return redirect()->route('donor_search_blood',auth()->guard('patien')->user()->id)->with(['searchDonor' => $searchDonor]);
            // return redirect()->back();
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function donor_search_blood($id){
        $patient = Patien::findOrFail($id);
        try{
            return view('backEnd.patien.donate.search_blood',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function addRequestDonor(Request $request){
        try{
            // return $request;
            $donorRequest = requestDonor::create([
                'accept' => false,
                'patientIdRequest'  => $request->patientIdRequest,
                'patientIdSender'   => $request->patientIdSender,
                'donor_id'     => $request->donor_id,
            ]);
            return response()->json([
                'data' => $donorRequest,
                'status'    => true
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function acceptRequestDonor(Request $request){
        try{
            $donorRequest = requestDonor::findOrFail($request->donorReqId);
            $donorRequest->accept = true;
            $donorRequest->save();
            return response()->json([
                'data'  => $donorRequest,
                'status'    => true
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function declineRequestDonor(Request $request){
        try{
            $donorRequest = requestDonor::findOrFail($request->donorReqId);
            $donorRequest->delete();
            return response()->json([
                'data'  => $donorRequest,
                'status'    => true
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }


    public function searchDevice(Request $request){
        try{
            $device = medicalDevices::where('medicalDevicesName',$request->search_device)->whereNotIn('patient_id',[auth()->guard('patien')->user()->id])->first();
            if(!$device){
                Alert::error('Error','Device Not Found');
                return redirect()->back();
            }
            return redirect()->route('getDevice',auth()->guard('patien')->user()->id)->with(['device' => $device]);
        }catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

    }

    public function searchMedication(Request $request){
        try{
            $patient = auth()->guard('patien')->user();
            $medication = Medication::where('medicationName',$request->search_medication)->whereNotIn('patient_id',[auth()->guard('patien')->user()->id])->first();
            if(!$medication){
                Alert::error('Error','Medication Not Found');
                return redirect()->back();
            }
            return redirect()->route('getMedication',auth()->guard('patien')->user()->id)->with(['medication' => $medication]);
        }catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function getDevice($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.donate.getDevice',compact('patient'));
        }catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function AddRequestDevice(Request $request){
        try{
            $medicalDevicesRequest = DeviceRequest::create([
                'accept' => false,
                'patientIdRequest'  => $request->patientIdRequest,
                'patientIdSender'   => $request->patientIdSender,
                'quantity'          => $request->quantity,
                'device_id'     => $request->device_id,
            ]);
            return response()->json([
                'data' => $medicalDevicesRequest,
                'status'    => true
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function AcceptRequestDevice(Request $request){
        try{
            $deviceRequest = DeviceRequest::findOrFail($request->deviceReqId);
            $deviceRequest->accept = true;
            //  $medRequest->donorForm->quantity =
            $deviceRequest->save();
            $device = medicalDevices::findOrFail($request->deviceId);
            $device->quantity =  $deviceRequest->donorForm->quantity - $deviceRequest->quantity;
            $device->save();
            return response()->json([
                'data'  => $deviceRequest,
                'status'    => true,
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function DeclineRequestDevice(Request $request){
        try{
            $deviceRequest = DeviceRequest::findOrFail($request->deviceReqId);
            $deviceRequest->delete();
            return response()->json([
                'data' => $deviceRequest,
                'status' => true
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function getMedication($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.donate.getMedication',compact('patient'));
        }catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function AddRequestMedication(Request $request){
        try{
            $medicationRequest = medicationRequest::create([
                'accept' => false,
                'patientIdRequest'  => $request->patientIdRequest,
                'patientIdSender'   => $request->patientIdSender,
                'quantity'          => $request->quantity,
                'medication_id'     => $request->medication_id,
            ]);
            return response()->json([
                'data'  => $medicationRequest,
                'status'    => true
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function AcceptRequestMedication(Request $request){
        try{
            $medRequest = medicationRequest::findOrFail($request->medSId);
            $medRequest->accept = true;
            //  $medRequest->donorForm->quantity =
            $medRequest->save();
            $medication = Medication::findOrFail($request->medId);
            $medication->quantity =  $medRequest->donorForm->quantity - $medRequest->quantity;
            $medication->save();
            return response()->json([
                'data'  => $medRequest,
                'status'    => true,
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function DeclineRequestMedication(Request $request){
        try{
            $medRequest = medicationRequest::findOrFail($request->medSId);
            $medRequest->delete();
            return response()->json([
                'data' => $medRequest,
                'status' => true
            ]);
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
}
