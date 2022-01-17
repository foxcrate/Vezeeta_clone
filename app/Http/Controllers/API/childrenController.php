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
        $hosptails = Patien::where('idCode', $request ->idCode) -> first();
        if ($hosptails) {
        $hosptail = Child::where('patient_id', $hosptails ->id) -> where('child_name', $request ->child_name)
        -> select(['weight', 'weight_type', 'height', 'blood']) -> first();
        if ($hosptail) {
        return response([
        'data' => $hosptail,
        'message' => 'success'
        ], 200);
        } else {
        return response(['message' => 'failed'],400);
        }
        } else {
        return response(['message' => 'failed'],400);
        }
     }
     //update disease in childern
    public function diseaseData(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if($patient) {
        $profileCreate = Child::where('patient_id', $patient->id)
        ->where('child_name',$request->child_name)
        ->update([
            'disease' => json_encode($request->disease)
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
        $patient->update(['Surgeries' => json_encode($request ->Surgeries)]);
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
                    'allergy' => json_encode($request ->allergy)
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
                    'message' => 'success'
                ]);
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
                    'message' => 'success'
                ]);
            }
        }}
        return response() -> json(['message' => 'failed'],400);
     }
    public function vaccinationsGet(Request $request) {
        $patient = Patien::where('idCode', $request ->idCode) -> first();
        if ($patient) {
            $patientChild = Child::where('patient_id', $patient ->id) -> where(
                'child_name',
                $request ->child_name
            ) -> first();
            if ($patientChild) {
                $vac = Vaccination::where('child_id', $patientChild ->id) -> count();
                if ($vac) {
                    $vac = Vaccination::where('child_id', $patientChild ->id) -> get();
                    return response() -> json([
                        'data' => $vac,
                        'message' => 'success'
                    ]);
                }
            } else {
                return response() -> json(['message' => 'failed'],400);
            }
        }
        return response() -> json(['message' => 'failed'],400);
     }
    public function medecation(Request $request){
            $patient = Patien::where('idCode', $request->idCode)->first();
            if($patient){
            $patient = Child::where('patient_id', $patient->id)->where('child_name',$request->child_name)->first();
            if($patient){
            $patient->update([
            'medication' => json_encode($request->medication)
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
            'fatherdisease' => json_encode($request->fatherdisease)
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
            $patient = Patien::where('idCode', $request->idCode)->first();
            if($patient){
            $patient = Child::where('patient_id', $patient->id)->where('child_name',$request->child_name)->first();
            if($patient ){
            $patient->update([
            'motherdisease' => json_encode($request->motherdisease)
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

    // New Couple's Functions

    public function getMyCouples(Request $request){

        $patient = Patien::where('idCode',$request->idCode)->first();
        // return $patient ;
        if($patient){
            //return $patient;
            $his_couples = $patient->myCouplesData();
            //return count($his_couples);
            if( count($his_couples)  > 0 ){
                return $his_couples;
            }else{
                return response()->json([
                    'message' => 'Patient Has No Couples'
                  ],400);
            }

        }else{
            return response()->json([
                'message' => 'Patient Not Found'
              ],400);
        }

    }

}
