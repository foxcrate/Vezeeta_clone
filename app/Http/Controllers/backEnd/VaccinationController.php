<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Vaccination;
use App\models\Patien;
use App\models\Child;
use App\Http\Requests\backEnd\child\VaccinationRequest;

class VaccinationController extends Controller
{
    public function StoreVaccination($id,$child_id,VaccinationRequest $request){
        try{
            $VaccinationRequest = $request->all();
            $patient = Patien::findOrFail($id);
            $child = Child::findOrFail($child_id);
            if(isset($VaccinationRequest['at_birth']) && count($VaccinationRequest['at_birth']) > 0){
                foreach($VaccinationRequest['at_birth'] as $item=> $v){
                    $array = [
                        'at_birth'  => $request->at_birth,
                        'two_month'  => $request->twoMonth,
                        'four_month'  => $request->fourMonth,
                        'six_month'  => $request->sixMonth,
                        'nine_month'  => $request->nineMonth,
                        'twelve_month'  => $request->twelveMonth,
                        'eighteen_month'  => $request->eighteenMonth,
                        'twenty_four_month'  => $request->fourtyTwo,
                        'child_id' => $request->child_id
                    ];
                }
            }
            // return $VaccinationRequest;
            $VaccinationCreate = Vaccination::create($array);
            return redirect()->route('child.edit.Vaccinations',[$patient->id,$child->id,$VaccinationCreate->id])->with(['success' => 'Vaccination added successfuly']);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }

    public function EditVaccinations($id,$child_id,$Vaccination_id){
        try{
            $patient = Patien::findOrFail($id);
            $child = Child::findOrFail($child_id);
            $Vaccination = Vaccination::findOrFail($Vaccination_id);
            return view('backEnd.patien.child.edit_Vaccinations',compact('patient','child','Vaccination'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
    public function UpdateVaccination($id,$child_id,$Vaccination_id,VaccinationRequest $request){
        try{
            $VaccinationRequest = $request->all();
            $patient = Patien::findOrFail($id);
            $child = Child::findOrFail($child_id);
            $Vaccination = Vaccination::findOrFail($Vaccination_id);
            if(isset($VaccinationRequest['at_birth']) && count($VaccinationRequest['at_birth']) > 0){
                foreach($VaccinationRequest['at_birth'] as $item=> $v){
                    $array = [
                        'at_birth'  => $request->at_birth,
                        'two_month'  => $request->twoMonth,
                        'four_month'  => $request->fourMonth,
                        'six_month'  => $request->sixMonth,
                        'nine_month'  => $request->nineMonth,
                        'twelve_month'  => $request->twelveMonth,
                        'eighteen_month'  => $request->eighteenMonth,
                        'twenty_four_month'  => $request->fourtyTwo,
                        'child_id' => $request->child_id
                    ];
                }
            }
            // return $VaccinationRequest;
            $VaccinationUpdate = $Vaccination->update($array);
            return redirect()->back()->with(['success' => 'Vaccination updated successfuly']);
            // return redirect()->route('child.Vaccinations',[$patient->id,$child->id])->with(['success' => 'Vaccination added successfuly']);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
}
