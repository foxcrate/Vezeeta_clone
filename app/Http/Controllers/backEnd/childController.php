<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backEnd\child\Store;
use App\Http\Requests\backEnd\child\StoreRocata;
use App\models\Child;
use App\models\Clinic;
use App\models\Hosptail;
use App\models\API\analyzes;
use App\models\API\Rays;
use App\models\Patien;
use App\models\RayChild;
use App\models\Rocata_child;
use App\models\TestChild;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
class childController extends Controller
{
    public function getKids($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.patien.getKids',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function create_child(Store $request,$id){
        // return $request;
        // try{
            Alert::success('Sucess','Child Added Sucess');
            /* patient find by id */
        $patient = Patien::findOrFail($id);
        /* insert all request */
        $childData = $request->all();
        /* check allergi name of count > 0 */
        // if(isset($childData['allergy']) && count($childData['allergy']) > 0){
            /* foreach data and insert request */
            // dd($requestData);
            // foreach($childData['allergy'] as $item=> $v){
                $data2 = [
                    'child_name'              => $request->child_name,
                    'birthDay'                => (new Carbon($request->birthDay))->timestamp,
                    'gender'                  => $request->gender,
                    'weight'                 => $request->weight ,
                    'height'                => $request->height,
                    'weight_type'            => $request->weight_type,
                    'blood'                 => $request->blood,
                    'disease'            => json_encode($request->disease),
                    'allergy'               => $request->allergi_data,
                    'Surgeries'             => $request->surgery_data,
                    'medication'            => $request->medication_name,
                    'motherdisease'            => json_encode($request->motherdisease),
                    'fatherdisease'            => json_encode($request->fatherdisease),
                    // 'patient_id'                => $request->patient_id
                ];
            // }

        // }
        if($request->image){
            $img = Image::make($request->image)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $request->image->hashName()));
            $data2['image'] = asset('uploads/' . $request->image->hashName());
        }
        // dd($request);
        // dd($request->all());
        $data2['patient_id'] = $request->patient_id;
        // return $data2;
        $child = Child::create($data2);

        /* return redirect profile patient */
        return redirect()->route('patient.child.profile',[$patient->id,$child['id']]);
        // }
        // catch(\Exception $ex){
        //     Alert::error('Error','Problem');
        //     return redirect()->back();
        // }
    }

    public function profile($id,$child_id){
        try{
            $patient = Patien::findOrFail($id);
            $child = Child::findOrFail($child_id);
            return view('backEnd.patien.child.profile',compact('patient','child'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function editProfile($id,$child_id){
        $patient = Patien::findOrFail($id);
        $child = Child::findOrFail($child_id);
        return view('backEnd.patien.child.edit',compact('patient','child'));
    }
    // get all child
    public function getAllChild($id){
        $patient = Patien::with('childern')->findOrFail($id);
        return view('backEnd.patien.child.getAllChild',compact('patient'));
    }

    // end get all child
    // update profile child
    public function updaeProfile($id,$child_id,Request $request){
        // try{
            Alert::success('Success','Updated Data Success');
            $patient = Patien::findOrFail($id);
            $child = Child::findOrFail($child_id);
            $childRequest = $request->all();

        // if(isset($childRequest['allergy']) && count($childRequest['allergy']) > 0){
            /* foreach data and insert request */
            // dd($requestData);
            // foreach($childRequest['allergy'] as $item=> $v){
                $data2 = [
                    'child_name'              => $request->child_name,
                    'birthDay'                => (new Carbon($request->birthDay))->timestamp,
                    'gender'                  => $request->gender,
                    'weight'                 => $request->weight ,
                    'height'                => $request->height,
                    'weight_type'            => $request->weight_type,
                    'blood'                 => $request->blood,
                    'disease'               => json_encode($request->disease),
                    'allergy'                   => $request->allergy,
                    'Surgeries'             => $request->Surgeries,
                    'medication'            => $request->medication,
                    'motherdisease'            => json_encode($request->motherdisease),
                    'fatherdisease'            => json_encode($request->fatherdisease),
                    // 'patient_id'                => $request->patient_id
                ];
        if($request->image){
            $img = Image::make($request->image)
            ->resize(1280,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $request->image->hashName()));
            $data2['image'] = asset('uploads/' . $request->image->hashName());
        }
        $data2['patient_id'] = $request->patient_id;
        // dd($data2);
        $child->update($data2);
        return redirect()->route('patient.child.profile',[$id,$child_id]);
        // }
        // catch(\Exception $ex){
        //     Alert::error('Error','problem');
        //     return redirect()->back();
        // }


    }
    // end update profile child
    // get All Children in patient
    public function clinic_all_children($id,$patient_id){
        try{
            $clinic = Clinic::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            return view('backEnd.patien.child.clinic_all_children',compact('clinic','patient'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

    }
    // get All Children in patient
    public function clinic_child_profile($id,$patient_id,$child_id){
            try{
            $clinic = Clinic::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $child = Child::findOrFail($child_id);
            return view('backEnd.patien.child.clinic_child_profile',compact('clinic','patient','child'));
            }


        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function child_add_prescription($id,$patient_id,$child_id){
        try{
            $clinic = Clinic::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $child = Child::findOrFail($child_id);
            $tests = analyzes::get();
            $rays = Rays::get();
            return view('backEnd.patien.child.child_add_prescription',compact('clinic','patient','child','tests','rays'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function child_store_prescription(StoreRocata $request){
        try{
            // return $request;
            Alert::success('Success','Prescrption Add Successfuly');
            // return $request;
            $childRocataRequest = $request->all();
            if(isset($childRocataRequest['medication']) && count($childRocataRequest['medication']) > 0){
                foreach($childRocataRequest['medication'] as $item => $v){
                    $roaucata_child_data = [
                        'prescription'  => $request->prescription,
                        'medication'=> $request->medication,
                        'child_id'    => $request->child_id,
                        'online_doctor_id'     => $request->doctor_id,
                    ];
                }
            }
            $rocataChild = Rocata_child::create($roaucata_child_data);
            if(isset($childRocataRequest['testName']) && count($childRocataRequest['testName']) > 0){
                foreach($childRocataRequest['testName'] as $item => $v){
                    $test_child_data = [
                        'test_name'=> $request->testName,
                        'child_id'    => $request->child_id,
                        'online_doctor_id'     => $request->doctor_id,
                        'rocata_child_id'     => $rocataChild->id
                    ];
                }
            }
            $test_child = TestChild::create($test_child_data);
            if(isset($childRocataRequest['rayName']) && count($childRocataRequest['rayName']) > 0){
                foreach($childRocataRequest['rayName'] as $item => $v){
                    $ray_child_data = [
                        'ray_name'=> $request->rayName,
                        'child_id'    => $request->child_id,
                        'online_doctor_id'     => $request->doctor_id,
                        'rocata_child_id'     => $rocataChild->id
                    ];
                }
            }
            $ray_child = RayChild::create($ray_child_data);
            return redirect()->back();
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }
    }

    public function child_old_prescrption($id,$patient_id,$child_id){
        try{
            $clinic = Clinic::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $child = Child::with('rocatas','test_child','ray_child')->findOrFail($child_id);
            return view('backEnd.patien.child.child_old_prescrption',compact('clinic','patient','child'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

    }

    public function child_all_prescrption($id,$patient_id,$child_id){
        try{
            $clinic = Clinic::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $child = Child::with('rocatas','test_child','ray_child')->findOrFail($child_id);
            return view('backEnd.patien.child.child_all_prescrption',compact('clinic','patient','child'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

    }

    public function hosptail_all_children($id,$patient_id){
        try{
            $hosptail = Hosptail::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            return view('backEnd.patien.child.hosptail_all_children',compact('hosptail','patient'));
        }
        catch(\Exception $ex){
            Alert::error('Error','Problem');
            return redirect()->back();
        }

    }

    public function hosptail_child_profile($id,$patient_id,$child_id){
        try{
            $hosptail = Hosptail::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $child = Child::findOrFail($child_id);
            return view('backEnd.patien.child.hosptail_child_profile',compact('hosptail','patient','child'));
        }

        catch(\Exception $ex){
        Alert::error('Error','Problem');
        return redirect()->back();
        }

    }

    public function hosptail_child_add_prescrption($id,$patient_id,$child_id){
        $hosptail = Hosptail::findOrFail($id);
        $patient = Patien::findOrFail($patient_id);
        $child = Child::findOrFail($child_id);
        $tests = analyzes::get();
        $rays = Rays::get();
        return view('backEnd.patien.child.hosptail_child_add_prescription',compact('hosptail','patient','child','tests','rays'));
    }
    public function hosptail_child_store_prescription(StoreRocata $request){
        try{
            // return $request;
            $childRocataRequest = $request->all();
            if(isset($childRocataRequest['medication']) && count($childRocataRequest['medication']) > 0){
                foreach($childRocataRequest['medication'] as $item => $v){
                    $roaucata_child_data = [
                        'prescription'  => $request->prescription,
                        'medication'=> json_encode($request->medication),
                        'child_id'    => $request->child_id,
                        'doctor_id'     => $request->doctor_id,
                    ];
                }
            }
            $rocataChild = Rocata_child::create($roaucata_child_data);
            if(isset($childRocataRequest['testName']) && count($childRocataRequest['testName']) > 0){
                foreach($childRocataRequest['testName'] as $item => $v){
                    $test_child_data = [
                        'test_name'=> json_encode($request->testName),

                        'child_id'    => $request->child_id,
                        'doctor_id'     => $request->doctor_id,
                        'rocata_child_id'     => $rocataChild->id
                    ];
                }
            }
            $test_child = TestChild::create($test_child_data);

            if(isset($childRocataRequest['rayName']) && count($childRocataRequest['rayName']) > 0){
                foreach($childRocataRequest['rayName'] as $item => $v){
                    $ray_child_data = [
                        'ray_name'=> json_encode($request->rayName),

                        'child_id'    => $request->child_id,
                        'doctor_id'     => $request->doctor_id,
                        'rocata_child_id'     => $rocataChild->id
                    ];
                }
            }
            $ray_child = RayChild::create($ray_child_data);
            return redirect()->back()->with(['success' => 'Prescrption Add Successfuly']);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function hosptail_child_old_prescrption($id,$patient_id,$child_id){
        try{
            $hosptail = Hosptail::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $child = Child::with('rocatas','test_child','ray_child')->findOrFail($child_id);
            return view('backEnd.patien.child.hosptail_child_old_prescrption',compact('hosptail','patient','child'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function hosptail_child_all_prescrption($id,$patient_id,$child_id){
        try{
            $hosptail = Hosptail::findOrFail($id);
            $patient = Patien::findOrFail($patient_id);
            $child = Child::with('rocatas','test_child','ray_child')->findOrFail($child_id);
            return view('backEnd.patien.child.hosptail_child_all_prescrption',compact('hosptail','patient','child'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }

    public function getVaccinations($id,$child_id){
        try{
            $patient = Patien::findOrFail($id);
            $child = Child::findOrFail($child_id);
            return view('backEnd.patien.child.getVaccinations',compact('patient','child'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
}
