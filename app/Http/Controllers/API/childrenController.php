<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\patientRequest;
use App\models\Child;
use App\models\Patien;
use App\models\Vaccination;
use App\models\OnlineDoctor;
use App\models\RayChild;
use App\models\Couples;
use App\models\TestChild;
use App\models\Rocata_child;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Auth;
class childrenController extends Controller
{
    //children register
    public function Register(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if ($patient) {
        $patientData = Child::where('patient_id', $patient->id)
        ->where('child_name',$request ->child_name)->first();
        if($patientData) {
        $profileCreate = Child::where('patient_id', $patient->id)->where('child_name',$request->child_name)
        ->update($request->all());
        return response()->json([
        'data' => $profileCreate,
        'message' => 'success'
        ]);
        } else {
        $profileCreate = Child::create([
            'child_name' => $request ->child_name,
            'image' => $request ->image,
            'birthDay' => $request ->birthDay,
            'gender' => $request ->gender,
            'patient_id' => $patient ->id
        ]);
        return response()->json([
        'data' => $profileCreate,
        'message' => 'success'
        ]);
        }
        }
        return response() -> json(['message' => 'faild'],400);
     }
     //return register get information
    public function RegisterGet(Request $request) {
        $hosptails = Patien::where('idCode', $request->idCode)->first();
        if ($hosptails) {
            $hosptail = Child::where('patient_id', $hosptails->id)->count();
            if($hosptail){
        $hosptail = Child::where('patient_id', $hosptails->id)->select(
        ['child_name', 'image', 'birthDay', 'gender'])-> get();
        return response([
        'data' => $hosptail,
        'message' => 'success'
        ], 200);
        }}
        return response(['message' => 'failed'],400);

     }
     //add basic date of children
    public function basicData(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if ($patient) {
            $patientData = Child::where('patient_id', $patient->id)->where('child_name',$request ->child_name)->first();
            if($patientData) {
                $patientData->update($request->except($request ->idCode));
                return response()->json([
                    'data' => $patientData,
                    'message' => 'success'
                ]);
            } else {
                return response()->json(['message' => 'faild'],400);
            }
        }
        return response()->json(['message' => 'faild'],400);
     }

    //return get children data with specific data
    public function getChildrenData(Request $request) {

        //return $request;

        $patient = Patien::where('idCode', $request ->idCode) -> first();
        //return $patient;

        if ($patient) {
            // $child = Child::where('patient_id', $patient ->id) -> where('child_name', $request ->child_name)
            //-> select(['weight', 'weight_type', 'height', 'blood']) -> first();

            $child = Child::where('patient_id', $patient ->id) -> where('child_name', 'LIKE' , '%' . $request ->child_name . '%' )-> first();

            //return $child ;
            if ($child) {
                return response( $child , 200);
            } else {
                return response(['Child Not Found' => 'failed'],410);
            }
        } else {
            return response(['Patient Not Found' => 'failed'],405);
        }

     }

    //update disease in childern
    public function diseaseData(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if($patient) {
        $profileCreate = Child::where('patient_id', $patient->id)
        ->where('child_name',$request->child_name)
        ->update([
            // 'disease' => json_encode($request->disease)
            'disease' => $request->disease
        ]);
        return response()->json([
                'data'    => $profileCreate,
                'message' => 'success'
            ]);
        }
        return response()->json(['message' => 'faild'],400);
     }

    //get disease
    public function diseaseGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if ($patient) {
            $medicationGet = Child::where('patient_id', $patient->id)
            ->where('child_name',$request ->child_name)
            ->select(['disease'])->first();
            if($medicationGet) {
                $medicationGet['disease'] = json_decode($medicationGet->disease);
                return response()->json([
                    'data' => $medicationGet,
                    'message' => 'success'
                ]);
            } else {
                return response()->json(['message' => 'faild'],400);
            }
        }
        return response()->json(['message' => 'faild'],400);
     }

    //post surgeries children
    public function Surgeries(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if ($patient) {
        $patient = Child::where('patient_id', $patient->id)
        ->where('child_name',$request->child_name)->first();
        if($patient){
        // $patient->update(['Surgeries' => json_encode($request ->Surgeries)]);
        $patient->update(['Surgeries' => $request ->Surgeries]);
        return response() -> json([
        'data' => $patient,
        'message' => 'success'
        ]);
        }}
        return response() -> json(['message' => 'faild'],400);
        }
    //get surgeries
    public function SurgeriesGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if($patient){
            $medicationGet = Child::where('patient_id', $patient->id)
            ->where('child_name',$request ->child_name)
            ->select(['Surgeries'])->first();
            if ($medicationGet) {
                $medicationGet['Surgeries'] = json_decode($medicationGet ->Surgeries);
                return response() -> json([
                    'data' => $medicationGet,
                    'message' => 'success'
                ]);
            } else {
                return response()->json(['message' => 'faild'],400);
            }}
        return response()->json(['message' => 'faild'],400);
     }
     //post allergy of children
    public function allergy(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if ($patient) {
            $patient = Child::where('patient_id', $patient->id)
            ->where('child_name',$request->child_name)->first();
            if ($patient) {
                $patient->update([
                    // 'allergy' => json_encode($request ->allergy)
                    'allergy' => $request ->allergy
                ]);
                return response()->json([
                    'data' => $patient,
                    'message' => 'success'
                ]);
            }}
            return response()->json(['message' => 'faild',400]);
        }
    //get allergy of children
    public function allergyGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if($patient){
        $medicationGet = Child::where('patient_id', $patient->id)
        -> where('child_name',$request->child_name)
        ->select(['allergy'])->first();
        if($medicationGet){
        $medicationGet['allergy'] = json_decode($medicationGet->allergy);
        return response()->json([
                    'data' => $medicationGet,
                    'message' => 'success'
                ]);
            }else{
                return response()->json(['message' => 'faild'],400);
            }}
        return response()->json(['message' => 'faild'],400);
     }
    //get the children name if idCode patient
    public function kidsGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode) -> first();
        if ($patient) {
            $medicationGet = Child::where('patient_id', $patient->id)->count();
            if ($medicationGet) {
                $medication = Child::where('patient_id', $patient->id)->get();
                return response()->json([
                    'data' => $medication,
                    'message' => 'success'
                ]);
            } else {
                return response()->json(['message' => 'faild'],400);
            }
        }
        return response()->json(['message' => 'faild'],400);
     }
    //post the vaccinationa children
    public function vaccinations(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if($patient){
            $child = Child::where('patient_id', $patient->id)
            ->where('child_name',$request->child_name)->first();
            if($child){
            $childvac = Vaccination::where('child_id', $child->id)->first();
            if($childvac){
                $childvac -> update([
                'at_birth'           => $request ->at_birth,
                'two_month'          => $request ->two_month,
                'four_month'         => $request ->four_month,
                'six_month'          => $request ->six_month,
                'nine_month'         => $request ->nine_month,
                'twelve_month'       => $request ->twelve_month,
                'eighteen_month'     => $request ->eighteen_month,
                'twenty_four_month'  => $request ->twenty_four_month,
                'child_id'           => $child ->id
                        ]);
                return response() -> json([
                    'data' => $childvac,
                ],200);
            } else {
                $childvac1 = Vaccination::create([
                    'at_birth' => $request ->at_birth,
                    'two_month' => $request ->two_month,
                    'four_month' => $request ->four_month,
                    'six_month' => $request ->six_month,
                    'nine_month' => $request ->nine_month,
                    'twelve_month' => $request ->twelve_month,
                    'eighteen_month' => $request ->eighteen_month,
                    'twenty_four_month' => $request ->twenty_four_month,
                    'child_id' => $child ->id
                ]);
                return response() -> json([
                    'data' => $childvac1,
                ],200);
            }
            }else{
                return response() -> json(['message' => 'Child Not Found'],410);
            }
        }else{

            return response() -> json(['message' => 'Patient Not Found'],405);
        }
     }
    public function vaccinationsGet(Request $request) {
        //return $request ;
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        //return $patient;
        if ($patient) {
            $patientChild = Child::where('patient_id', $patient ->id) -> where(
                'child_name',
                $request ->child_name
            ) -> first();
            if ($patientChild) {
                //return $patientChild;
                $vac = Vaccination::where('child_id', $patientChild ->id) -> count();
                if ($vac) {
                    $vac = Vaccination::where('child_id', $patientChild ->id) -> get();
                    return response() -> json([
                        'data' => $vac,
                        'message' => 'success'
                    ]);
                }else{
                    return response() -> json(['message' => "Kid Didn't get any vaccinations"],200);
                }
            } else {
                return response() -> json(['Child Not Found' => 'failed'],410);
            }
        }
        return response() -> json(['message' => 'Patient Not Found'],405);
     }
    public function medecation(Request $request){
        //return json_encode($request->medication);
        $patient = Patien::where('idCode', $request->idCode)->first();
        if($patient){
            $patient = Child::where('patient_id', $patient->id)->where('child_name',$request->child_name)->first();
            if($patient){
                $patient->update([
                    // 'medication' => json_encode($request->medication)
                    'medication' => $request->medication
                ]);
                return response()->json([
                    'data' => $patient,
                    'message'   => 'success',
                ]);
            }
        }
        return response()->json([
        'message'   => 'faild',
        ],400);
    }



    public function medecationGet(Request $request){
            $patient = Patien::where('idCode', $request->idCode)->first();
            if($patient ){
            $medicationGet = Child::where('patient_id',$patient->id)->where('child_name',$request->child_name)->select(['medication'])->first();
            if($medicationGet){
            $medicationGet['medication']= json_decode($medicationGet->medication);
            return response()->json([
            'data' => $medicationGet,
            'message'   => 'success',
            ],200);
        }
            else{
            return response()->json([
            'message'   => 'faild',
            ],400);
            }
            }
            return response()->json([
            'message'   => 'faild',
            ],400);
     }
    public function fatherdisease(Request $request){
            $patient = Patien::where('idCode', $request->idCode)->first();
            if($patient){
            $patient = Child::where('patient_id', $patient->id)->where('child_name',$request->child_name)->first();
            if($patient ){
            $patient->update([
            // 'fatherdisease' => json_encode($request->fatherdisease)
            'fatherdisease' => $request->fatherdisease
            ]);
            return response()->json([
            'data' => $patient,
            'message'   => 'success',
            ],200);

            }}
            return response()->json([
            'message'   => 'faild',
            ],400);
     }
    public function fatherdiseaseGet(Request $request){
            $patient = Patien::where('idCode', $request->idCode)->first();
            if($patient ){
            $medicationGet = Child::where('patient_id',$patient->id)->where('child_name',$request->child_name)->select(['fatherdisease'])->first();
            if($medicationGet){
            $medicationGet['fatherdisease']= json_decode($medicationGet->fatherdisease);
            return response()->json([
            'data' => $medicationGet,
            'message'   => 'success',
            ]);}
            else{
            return response()->json([
            'message'   => 'faild',
            ],400);
            }
            }
            return response()->json([
            'message'   => 'faild',
            ],400);
     }

    public function motherdisease(Request $request){
        //return "Alo Post";
        $patient = Patien::where('idCode', $request->idCode)->first();
        if($patient){
            $patient = Child::where('patient_id', $patient->id)->where('child_name',$request->child_name)->first();
            if($patient ){
            $patient->update([
            // 'motherdisease' => json_encode($request->motherdisease)
            'motherdisease' => $request->motherdisease
            ]);
            return response()->json([
            'data' => $patient,
            'message'   => 'success',
            ]);
        }}
        return response()->json([
            'message'   => 'faild',
        ],400);
    }

    public function motherdiseaseGet(Request $request){
        //return "Alo Get";
            $patient = Patien::where('idCode', $request->idCode)->first();
            if($patient ){
            $medicationGet = Child::where('patient_id',$patient->id)->where('child_name',$request->child_name)->select(['motherdisease'])->first();
            if($medicationGet){
            $medicationGet['motherdisease']= json_decode($medicationGet->motherdisease);
            return response()->json([
            'data' => $medicationGet,
            'message'   => 'success',
            ]);}
            else{
            return response()->json([
            'message'   => 'faild',
            ],400);
            }
            }
            return response()->json([
            'message'   => 'faild',
            ],400);
        }
    public function rocataChildren(Request $request){
        $patient = Patien::where('idCode', $request->idCode)->first();
        if($patient){
        $doctor = OnlineDoctor::where('idcode',$request->id)->first();
        if($doctor){
        $child = Child::where('patient_id',$patient->id)->where('child_name',$request->child_name)->first();
        if($child){
        $rocata = Rocata_child::create([
        'prescription'     => $request->prescription,
        'medication'       => $request->medication,
        'jaw_type'         => $request->jaw_type,
        'date'             => $request->date,
        'jaw_direction'    => $request->jaw_direction,
        'teeth_type'       => $request->teeth_type,
        'eye_type'         => $request->eye_type,
        'child_id'         => $child->id,
        'online_doctor_id' => $doctor->id,
            ]);
            return response()->json([
            'data' => $rocata,
            'message' => 'success',
            ]);
            }}}
        return response()->json([
            'message' => 'faild'
        ],400);
    }
    public function rocataChildrenGet(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if ($patient) {
        $doctor = OnlineDoctor::where('idcode', $request ->id) -> first();
            if ($doctor) {
                $child = Child::where('patient_id', $patient ->id) -> where(
                    'child_name',
                    $request ->child_name
                ) -> first();
                if ($child) {
                    $rocata = Rocata_child::with ('online_doctor') -> where(
                            'online_doctor_id',
                            $doctor ->id
                        ) -> where('child_id', $child ->id) -> get();
                    return response() -> json([
                        'data' => $rocata,
                        'message' => 'success'
                    ]);
                }
            }
        }
        return response() -> json(['message' => 'faild'],400);
     }
     //get all prescription of children
     public function allRocataChildrenGet(Request $request) {
        $patient = Patien::where('idCode', $request->idCode)->first();
        if($patient) {
        $child = Child::where('patient_id', $patient->id)
        ->where('child_name',$request->child_name)->first();
        if($child) {
        $rocata = Rocata_child::where('child_id', $child->id)->count();
        if($rocata){
        $rocata = Rocata_child::with ('online_doctor')
        ->where('child_id', $child->id)->get();
            return response() -> json([
                'data' => $rocata,
                'message' => 'success'
            ]);
        }}}
        return response() -> json(['message' => 'faild'],400);
     }
    public function rayChildren(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if($patient){
        $doctor = OnlineDoctor::where('idcode', $request ->id) -> first();
        if($doctor){
        $child = Child::where('patient_id', $patient ->id) -> where(
            'child_name',
            $request ->child_name
        ) -> first();
        if ($child) {
            $rocata = RayChild::create([
                'ray_name' => $request ->ray_name,
                'child_id' => $child ->id,
                'online_doctor_id' => $doctor ->id,
                'date' => $request ->date,
                'link' => $request ->link
            ]);
            return response() -> json([
                'data' => $rocata,
                'message' => 'success'
            ],200);
        }}}
        return response() -> json(['message' => 'faild'],400);
     }
    public function rayChildrenUpdate(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if($patient){
        $doctor = OnlineDoctor::where('idcode', $request ->id) -> first();
        if($doctor){
        $child = Child::where('patient_id', $patient ->id) -> where(
            'child_name',
            $request ->child_name
        ) -> first();
        if ($child) {
        $rocata = RayChild::where('id', $request ->ID) -> where(
            'online_doctor_id',
            $doctor ->id
        ) -> where('child_id', $child ->id) -> first();
            if ($rocata) {
                $rocata -> update(['link' => $request ->link]);
                return response() -> json([
                    'data' => $rocata,
                    'message' => 'success'
                ]);
            }
        }}}
        return response() -> json(['message' => 'faild'],400);
     }
    public function allRayChildrenGet(Request $request) {
         $patient = Patien::where('idCode', $request->idCode)->first();
         if($patient){
          $child = Child::where('patient_id', $patient->id)->where('child_name',$request->child_name)->first();
                if ($child) {
                $rocata = RayChild::where('child_id',$child ->id)->count();
                if($rocata){
                $rocata = RayChild::with ('online_doctor')->where('child_id',$child ->id)->get();
                return response() -> json([
                'data' => $rocata,
                'message' => 'success'
                ]);
                }}}
        return response() -> json(['message' => 'faild'],400);
    }
public function rayChildrenGet(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if ($patient) {
        $doctor = OnlineDoctor::where('idcode', $request ->id) -> first();
            if ($doctor) {
                $child = Child::where('patient_id', $patient ->id) -> where(
                    'child_name',
                    $request ->child_name
                ) -> first();
                if ($child) {
                    $rocata = RayChild::with ('online_doctor') -> where(
                            'child_id',
                            $child ->id
                        ) -> where('online_doctor_id', $doctor ->id) -> count();
                        if($rocata){
                            $rocata = RayChild::with ('online_doctor') -> where(
                                'child_id',
                                $child ->id
                            ) -> where('online_doctor_id', $doctor ->id) -> get();
                    return response() -> json([
                        'data' => $rocata,
                        'message' => 'success'
                    ],200);
                }
            }}
        }
        return response() -> json(['message' => 'faild'],400);
     }
    public function testChildren(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if($patient){
        $doctor = OnlineDoctor::where('idcode', $request ->id) -> first();
        if($doctor){
        $child = Child::where('patient_id', $patient ->id) -> where(
            'child_name',
            $request ->child_name
        ) -> first();
        if ($child) {
            $rocata = TestChild::create([
                'test_name' => $request ->test_name,
                'child_id' => $child ->id,
                'online_doctor_id' => $doctor->id,
                'date' => $request ->date,
                'link' => $request ->link
            ]);
            return response() -> json([
                'data' => $rocata,
                'message' => 'success'
            ],200);
        }}}
        return response() -> json(['message' => 'faild'],400);
     }
    public function testChildrenUpdate(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if($patient){
        $doctor = OnlineDoctor::where('idcode', $request ->id) -> first();
        if($doctor){
        $child = Child::where('patient_id', $patient ->id) -> where(
            'child_name',
            $request ->child_name
        ) -> first();
        if($child){
        $rocata = TestChild::where('id', $request ->ID) -> where(
            'online_doctor_id',
            $doctor ->id
        ) -> where('child_id', $child ->id) -> first();
        if ($rocata) {
                $rocata -> update(['link' => $request ->link]);
                return response() -> json([
                    'data' => $rocata,
                    'message' => 'success'
                ],200);
            }
        }}}
        return response() -> json(['message' => 'faild'],400);
     }
     public function allTestChildrenGet(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if ($patient) {
                $child = Child::where('patient_id', $patient ->id) -> where(
                    'child_name',
                    $request ->child_name
                ) -> first();
                if ($child) {
                    $rocata = TestChild::where(
                            'child_id',
                            $child ->id
                        )-> count();
                        if($rocata){
                            $rocata = TestChild::with ('online_doctor') -> where(
                                'child_id',
                                $child ->id
                            )->get();
                    return response() -> json([
                        'data' => $rocata,
                        'message' => 'success'
                    ]);
                }}}
        return response() -> json(['message' => 'faild'],400);
     }
    public function testChildrenGet(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if ($patient) {
        $doctor = OnlineDoctor::where('idcode', $request ->id) -> first();
            if ($doctor) {
                $child = Child::where('patient_id', $patient ->id) -> where(
                    'child_name',
                    $request ->child_name
                ) -> first();
                if ($child) {
                    $rocata = TestChild::with ('online_doctor') -> where(
                            'child_id',
                            $child ->id
                        ) -> where('online_doctor_id', $doctor ->id) -> count();
                        if($rocata){
                            $rocata = TestChild::with ('online_doctor') -> where(
                                'child_id',
                                $child ->id
                            ) -> where('online_doctor_id', $doctor ->id) -> get();
                    return response() -> json([
                        'data' => $rocata,
                        'message' => 'success'
                    ]);
                }
            }}
        }
        return response() -> json(['message' => 'faild'],400);
    }

    public function setCouples(Request $request){
        $patien = Patien::where('idCode',$request->idCode)->first();
        if($patien){
        $patien2 = Patien::where('idCode',$request->id)->first();
            if($patien2){
            $couples = Couples::create([
                'patientRequest_id' => $patien->id ,
                'patientAccept_id' => $patien2->id,
                'idCode' => $patien->idCode,
            ]);
            return response()->json([
                'data' => $couples,
                'message'=> 'success',
            ],200);
            }
        }
        return response()->json([
        'message' => 'faild'
        ],400);
    }

    public function setCouplesGet(Request $request){
        //return $request;
        $patien2 = Patien::where('idCode',$request->idCode)->first();
        //return $patien2;

        if($patien2){
            $couples = Couples::where('patientAccept_id',$patien2->id)->where('couples',0)->count();
            //return $couples;

            if($couples){
                $couples = Couples::with('patient')->where('patientAccept_id',$patien2->id)->where('couples',0)->get();
                return response()->json([
                    'data' => $couples,
                    'message'=> 'success',
                ]);
            }
        }

        return response()->json([
          'message' => 'faild'
        ],400);
    }

    public function acceptCouples(Request $request){
        $patien = Patien::where('idCode',$request->idCode)->first();
        if($patien){
        $patien2 = Patien::where('idCode',$request->id)->first();
            if($patien2){
                $couples = Couples::where('patientRequest_id',$patien2->id )
                ->where('patientAccept_id',$patien->id)->first();
                if($couples){
               $couples = Couples::where('patientRequest_id',$patien2->id )
               ->where('patientAccept_id',$patien->id)->update([
               'couples' => $request->couples,
               ]);
               return response()->json([
                   'data' => $couples,
                   'message'=> 'success',
               ],200);
            }
        }}
        return response()->json([
          'message' => 'faild'
        ],400);
    }

    public function declineCouples(Request $request){
        $patien = Patien::where('idCode',$request->idCode)->first();
        if($patien){
        $patien2 = Patien::where('idCode',$request->id)->first();
            if($patien2){
                $couples = Couples::where('patientRequest_id',$patien2->id )
               ->where('patientAccept_id',$patien->id)->where('couples',0)->first();
                if($couples){
               $couples = Couples::where('patientRequest_id',$patien2->id )
               ->where('patientAccept_id',$patien->id)->where('couples',0)->delete();
               return response()->json([
                   'data' => $couples,
                   'message'=> 'success',
               ]);
            }
        }}
        return response()->json([
          'message' => 'faild'
        ],400);
    }

    public function removeCouples(Request $request){
        //return "Alpo";
        $patien2 = Patien::where('idCode',$request->idCode)->first();
        $patien1 = Patien::where('idCode',$request->id)->first();
        if($patien2){
        $couples = Couples::where('patientRequest_id',$patien2->id)->where('patientAccept_id',$patien1->id)->where('couples',1)->count();
        if($couples){
        $couples = Couples::where('patientRequest_id',$patien2->id)->where('patientAccept_id',$patien1->id)->where('couples',1)->delete();
        return response()->json([
                'data' => $couples,
                'message'=> 'success',
            ]);
            }
            $co = Couples::where('patientAccept_id',$patien2->id)->where('patientRequest_id',$patien1->id)->where('couples',1)->count();
            if($co){
                $co = Couples::where('patientAccept_id',$patien2->id)->where('patientRequest_id',$patien1->id)->delete();
                return response()->json([
                        'data' => $co,
                        'message'=> 'success',
                    ]);
            }
        }
        return response()->json([
            'message' => 'faild'
            ],400);
    }

    public function requestCouplesGet(Request $request){

        $patien2 = Patien::where('idCode',$request->idCode)->first();
            if($patien2){
               $couples = Couples::where('patientRequest_id',$patien2->id)->where('couples',1)->count();
               if($couples){
                $couples = Couples::with('patientRequest')->where('patientRequest_id',$patien2->id)->where('couples',1)->get();
               return response()->json([
                   'data' => $couples,
                   'message'=> 'success',
               ]);
               }}
        return response()->json([
          'message' => 'faild'
        ],400);

    }

    public function getIdcodeCouples(Request $request){

        $patien2 = Patien::where('idCode',$request->idCode)->first();
        if($patien2){
        $couples = Couples::where('patientRequest_id',$patien2->id)->where('couples',1)->count();
        if($couples){
        $couples = Couples::with('patientRequest')->where('patientRequest_id',$patien2->id)->where('couples',1)->get();
        return response()->json([
                'data' => $couples,
                'message'=> 'success',
            ]);
            }
            $co = Couples::where('patientAccept_id',$patien2->id)->where('couples',1)->count();
            if($co){
                $co = Couples::with('patient')->where('patientAccept_id',$patien2->id)->where('couples',1)->get();
                return response()->json([
                        'data' => $co,
                        'message'=> 'success',
                    ]);
            }
        }
        return response()->json([
            'message' => 'faild'
          ],400);

    }


    ///////////////////////////////////////////////////// New APIs ////////////////////////////////////////////////////

    // New Couple's Functions

    public function getMyCouples(Request $request){

        $patient = Patien::where('idCode',$request->idCode)->first();
        // return $patient ;
        if($patient){
            //return $patient;
            $his_couples = $patient->myCouplesData();
            //return $his_couples ;
            if( count($his_couples)  > 0 ){
                return $his_couples;
            }else{
                return response()->json([
                    'message' => 'Patient Has No Couples'
                  ],410);
            }

        }else{
            return response()->json([
                'message' => 'Patient Not Found'
              ],405);
        }

    }

    public function sendCouplesRequest(Request $request){

        $sender_patient = Patien::where('idCode',$request->sender_idCode)->first();
        $receiver_patient = Patien::where('idCode',$request->receiver_idCode)->first();

        // $x=[ $sender_patient , $receiver_patient ];
        // return $x;

        // return $patient ;
        if( $sender_patient && $receiver_patient ){

            // $existRequest = Couples::where('patientRequest_id' , $sender_patient->id)->orWhere('patientAccept_id' , $receiver_patient->id)->orWhere('patientAccept_id' , $sender_patient->id)->orWhere('patientRequest_id' , $receiver_patient->id)->get();
            $existRequest = Couples::where( 'patientRequest_id' , $sender_patient->id )->where( 'patientAccept_id' , $receiver_patient->id )->orWhere( 'patientRequest_id' , $receiver_patient->id )->where( 'patientAccept_id' , $sender_patient->id )->get();
            //return count($existRequest);

            if( count($existRequest) > 0 )
            {

                return response()->json([
                    'message' => 'You Have Already Tried To Connect With This User'
                ],410);

            }else{

                $CouplesCreate = Couples::create([
                    'patientAccept_id'  => $receiver_patient->id,
                    'patientRequest_id'  => $sender_patient->id,
                    'couples'   => false,
                ]);

                return response()->json([
                    'message' => 'Request Sent'
                ],200);

            }

        }else{
            return response()->json([
                'message' => 'Patients Not Found'
              ],405);
        }

    }

    public function responseCouplesRequest(Request $request){

      //return $request ;

      $request_couple = Couples::find($request->request_couple_id);

      if( $request_couple ){



        if( $request->response == 1 ){

            $request_couple->couples = 1;
            $request_couple->save() ;

        }elseif( $request->response == 0 ){
            $request_couple->delete();
        }

        return response()->json([
            'message' => 'Request Updated Successfully'
        ],200);

      }
      else{
        return response()->json([
            'message' => 'Request Not Found'
          ],405);
      }

    }

    public function getMyCouplesRequests(Request $request){

        //return $request;

        $receiver_patient = Patien::where( 'idCode' , $request->idCode )->first();
        //return $receiver_patient;

        if($receiver_patient){

            //return $receiver_patient->id;
            $request_couple = Couples::where( 'patientAccept_id' , $receiver_patient->id)->where( 'couples', 0 )->with( 'patientRequest' )->get();
            if( count( $request_couple ) > 0){
                return $request_couple ;
            }else{
                return response()->json([
                    'message' => 'Patient Has No Couples Requests'
                  ],410);
            }


        }else{
            return response()->json([
                'message' => 'Patient Not Found'
              ],405);
        }

    }

    public function deleteMyCouple(Request $request){

        //return $request;

        $iPatient = Patien::where( 'idCode' , $request->MyidCode )->first();
        $otherPatient = Patien::where( 'idCode' , $request->OtheridCode )->first(); ;

        // $x=[ $iPatient , $otherPatient ];
        // return $x;

        if( $iPatient && $otherPatient ){

            $the_request = Couples::where('couples',1)->where( 'patientRequest_id' , $iPatient->id )->where( 'patientAccept_id' , $otherPatient->id )->orWhere( 'patientAccept_id' , $iPatient->id )->where( 'patientRequest_id' , $otherPatient->id )->first();

            if( $the_request ){

                $the_request->delete();

                return response()->json([
                    'message' => 'Couple Deleted Successfully'
                ],200);

            }else{
                return response()->json([
                    'message' => 'Couple Not Found'
                  ],410);
            }

        }else{
            return response()->json([
                'message' => 'Patient Not Found'
              ],405);
        }

    }

    public function removeKid(Request $request){

        //return $request ;

        $patient = Patien::where('idCode',$request->idCode)->first();

        if($patient){

            $patient_child = Child::find( $request->child_id );

            if($patient_child){

                $patient_child->delete();

                return response()->json([
                    'message' => 'Child Deleted Successfully'
                ],200);

            }else{
                return response()->json([
                    'message' => 'Child Not Found'
                  ],410);
            }

        }else{
            return response()->json([
                'message' => 'Patient Not Found'
            ],405);
        }

    }

    public function kidRegister(Request $request){

        //return $request;

        // 'title' => 'required|unique:posts|max:255',
        // 'body' => 'required',

        $validator = Validator::make( $request->all(), [
            'child_name' => 'required',
            //'image' => 'required',
            'birthDay' => 'required',
            'gender' => 'required',
            'weight' => 'required',
            'weight_type' => 'required',
            // 'height' => 'required',
            // 'blood' => 'required',
            // 'disease' => 'required',
            // 'Surgeries' => 'required',
            // 'allergy' => 'required',
            // 'medication' => 'required',
            // 'fatherdisease' => 'required',
            // 'motherdisease' => 'required',
            'patient_idCode' => 'required',
        ] );

        if ($validator->fails()) {
            // return redirect('post/create')
            //             ->withErrors($validator)
            //             ->withInput();

            //return $validator->errors();
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $patient = Patien::where('idCode',$request->patient_idCode)->first();

        if($patient){

            $patient_children = $patient->childern;

            $repeated_child_name = false;
            foreach( $patient_children as $patient_child ){

                if( $patient_child->child_name == $request ->child_name ){
                    $repeated_child_name = true ;
                }

            }

            if($repeated_child_name == false){

                $new_child = Child::create([
                    'child_name' => $request ->child_name,
                    'image' => $request ->image,
                    'birthDay' => $request ->birthDay,
                    'gender' => $request ->gender,
                    'weight' => $request -> weight,
                    'weight_type' => $request -> weight_type,
                    'height' => $request -> height,
                    'blood' => $request -> blood,
                    'disease' => $request -> disease,
                    'Surgeries' => $request -> Surgeries,
                    'allergy' => $request -> allergy,
                    'medication' => $request -> medication,
                    'fatherdisease' => $request -> fatherdisease,
                    'motherdisease' => $request -> motherdisease,
                    'patient_id' => $patient ->id
                ]);

                //return $new_child ;

                return response()->json([
                    'message' => 'Patient Created Successfully',
                    'data' => $new_child
                ],200);

            }else{
                return response()->json([
                    'message' => 'Repeated Child Name'
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Patient Not Found'
            ],410);
        }

    }

    public function kidsDiseaseGet(Request $req){
        // return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            if($kid->disease){
                return response()->json([
                    'data' => $kid->disease
                ],200);
            }else{
                return response()->json([
                    'message' => 'Kid Has No Diseases'
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidsDiseasePost(Request $req){
        //return $req;

        //return json_encode($req->diseases);

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required',
            'diseases' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            // $kid->disease = explode(',',$req->diseases);
            $kid->disease = $req->diseases;
            $kid->save();
            //return $kid;
            return response()->json([
                'message' => 'Updated Successfully',
                'data'=> $kid->disease
            ],200);

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidSurgeriesGet(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            if($kid->fatherdisease){
                return response()->json([
                    'data' => $kid->Surgeries
                ],200);
            }else{
                return response()->json([
                    'message' => "Kid's Father Has No Surgeries"
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidSurgeriesPost(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required',
            'surgeries' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            // $kid->disease = explode(',',$req->diseases);
            $kid->Surgeries = $req->surgeries;
            $kid->save();
            //return $kid;
            return response()->json([
                'message' => 'Updated Successfully',
                'data'=> $kid->Surgeries
            ],200);

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidAllergiesGet(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            if($kid->allergy){
                return response()->json([
                    'data' => $kid->allergy
                ],200);
            }else{
                return response()->json([
                    'message' => "Kid's Father Has No Allergies"
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidAllergiesPost(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required',
            'allergies' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            // $kid->disease = explode(',',$req->diseases);
            $kid->allergy = $req->allergies;
            $kid->save();
            //return $kid;
            return response()->json([
                'message' => 'Updated Successfully',
                'data'=> $kid->allergy
            ],200);

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidMedicationsGet(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            if($kid->medication){
                return response()->json([
                    'data' => $kid->medication
                ],200);
            }else{
                return response()->json([
                    'message' => "Kid's Father Has No Medications"
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidMedicationsPost(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required',
            'medications' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            // $kid->disease = explode(',',$req->diseases);
            $kid->medication = $req->medications;
            $kid->save();
            //return $kid;
            return response()->json([
                'message' => 'Updated Successfully',
                'data'=> $kid->medication
            ],200);

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidFatherDiseasesGet(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            if($kid->fatherdisease){
                return response()->json([
                    'data' => $kid->fatherdisease
                ],200);
            }else{
                return response()->json([
                    'message' => "Kid's Father Has No Diseases"
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidFatherDiseasesPost(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required',
            'diseases' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            // $kid->disease = explode(',',$req->diseases);
            $kid->fatherdisease = $req->diseases;
            $kid->save();
            //return $kid;
            return response()->json([
                'message' => 'Updated Successfully',
                'data'=> $kid->fatherdisease
            ],200);

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidMotherDiseasesGet(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            if($kid->motherdisease){
                return response()->json([
                    'data' => $kid->motherdisease
                ],200);
            }else{
                return response()->json([
                    'message' => "Kid's Mother Has No Diseases"
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidMotherDiseasesPost(Request $req){
        //return $req;

        $validator = Validator::make( $req->all(), [
            'child_id' => 'required',
            'diseases' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($req->child_id);

        if($kid){

            // $kid->disease = explode(',',$req->diseases);
            $kid->motherdisease = $req->diseases;
            $kid->save();
            //return $kid;
            return response()->json([
                'message' => 'Updated Successfully',
                'data'=> $kid->motherdisease
            ],200);

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }
        //return $kid->disease;

    }

    public function kidVaccinationsGet(Request $request){
        //return $request;

        // $kid = Child::find($request->child_id);
        // return $kid->Vaccination;

        $validator = Validator::make( $request->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($request->child_id);

        if($kid){

            if($kid->Vaccination){
                return response()->json([
                    'data' => $kid->Vaccination
                ],200);
            }else{
                return response()->json([
                    'message' => "Kid Has No Vaccinations"
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }

    }

    public function kidVaccinationsPost(Request $request){

        //return $request['at_birth'];

        $validator = Validator::make( $request->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($request->child_id);

        if($kid){

            $array = [
                'at_birth'  => null,
                'two_month'  => null,
                'four_month'  => null,
                'six_month'  => null,
                'nine_month'  => null,
                'twelve_month'  => null,
                'eighteen_month'  => null,
                'twenty_four_month'  => null,
                'child_id' => $request->child_id
            ];

            if(isset($request['at_birth'])){
                $array['at_birth'] = $request->at_birth;
            }
            if(isset($request['twoMonth'])){
                $array['two_month'] = $request->twoMonth;
            }
            if(isset($request['fourMonth'])){
                $array['four_month'] = $request->fourMonth;
            }
            if(isset($request['sixMonth'])){
                $array['six_month'] = $request->sixMonth;
            }
            if(isset($request['nineMonth'])){
                $array['nine_month'] = $request->nineMonth;
            }
            if(isset($request['twelveMonth'])){
                $array['twelve_month'] = $request->twelveMonth;
            }
            if(isset($request['eighteenMonth'])){
                $array['eighteen_month'] = $request->eighteenMonth;
            }
            if(isset($request['fourtyTwo'])){
                $array['twenty_four_month'] = $request->fourtyTwo;
            }

            $child_vaccination = Vaccination::where('child_id', $kid->id)->first();
            if($child_vaccination){
                $child_vaccination -> update($array);
                return response() -> json([
                    'data' => $child_vaccination,
                ],200);
            } else {
                $child_vaccination = Vaccination::create($array);
                return response() -> json([
                    'data' => $child_vaccination,
                ],200);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }

    }

    public function kidsRocataGet(Request $request){
        //return $request;
        $validator = Validator::make( $request->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($request->child_id);

        if($kid){

            if($kid->rocatas){
                $rocatas = Rocata_child::where('child_id', $kid ->id)->with ('online_doctor') -> get();

                return response()->json([
                    'data' => $rocatas
                ],200);

            }else{
                return response()->json([
                    'message' => "Kid Has No Rocatas"
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }

    }

    public function kidsRocataPost(Request $request){
        //return $request;

        $validator = Validator::make( $request->all(), [
            'child_id' => 'required',
            'prescription' => 'required',
            'date' => 'required',
            'online_doctor_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($request->child_id);

        if($kid){

            $rocata = Rocata_child::create([
                'prescription'     => $request->prescription,
                'medication'       => $request->medication,
                'jaw_type'         => $request->jaw_type,
                'date'             => $request->date,
                'jaw_direction'    => $request->jaw_direction,
                'teeth_type'       => $request->teeth_type,
                'eye_type'         => $request->eye_type,
                'child_id'         => $kid->id,
                'online_doctor_id' => $request->online_doctor_id,
                ]);

            return response()->json([
                'data' => $rocata
            ],200);

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }

    }

    public function kidRaysGet(Request $request){

        // return $request;
        $validator = Validator::make( $request->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($request->child_id);

        if($kid){

            if($kid->ray_child){
                $rays = RayChild::where('child_id', $kid ->id)->with ('online_doctor') -> get();

                return response()->json([
                    'data' => $rays
                ],200);

            }else{
                return response()->json([
                    'message' => "Kid Has No Rays"
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }

    }

    public function kidRaysPost(Request $request){

        // return $request;
        $validator = Validator::make( $request->all(), [
            'child_id' => 'required',
            'ray_name' => 'required',
            'link' => 'required',
            'date' => 'required',
            'online_doctor_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($request->child_id);

        if($kid){

            $ray = RayChild::create([
                'ray_name' => $request ->ray_name,
                'child_id' => $kid ->id,
                'online_doctor_id' => $request ->online_doctor_id,
                'date' => $request ->date,
                'link' => $request ->link
            ]);

            return response()->json([
                'data' => $ray
            ],200);

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }

    }

    public function kidTestsGet(Request $request){

        // return $request;
        $validator = Validator::make( $request->all(), [
            'child_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($request->child_id);

        if($kid){

            if($kid->test_child){

                $tests = TestChild::with ('online_doctor') -> where(
                    'child_id',
                    $kid ->id
                )->get();

                return response()->json([
                    'data' => $tests
                ],200);

            }else{
                return response()->json([
                    'message' => "Kid Has No Tests"
                ],415);
            }

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }

    }

    public function kidTestsPost(Request $request){

        // return $request;
        $validator = Validator::make( $request->all(), [
            'child_id' => 'required',
            'test_name' => 'required',
            'link' => 'required',
            'date' => 'required',
            'online_doctor_id' => 'required'
        ] );

        if ($validator->fails()) {
            return response()->json( ['errors'=>$validator->errors()] , 405 );
        }

        $kid = Child::find($request->child_id);

        if($kid){

            $ray = TestChild::create([
                'test_name' => $request ->test_name,
                'child_id' => $kid ->id,
                'online_doctor_id' => $request ->online_doctor_id,
                'date' => $request ->date,
                'link' => $request ->link
            ]);

            return response()->json([
                'data' => $ray
            ],200);

        }else{
            return response()->json([
                'message' => 'Kid Not Found'
            ],410);
        }

    }

}

