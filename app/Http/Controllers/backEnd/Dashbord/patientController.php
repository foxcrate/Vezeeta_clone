<?php

namespace App\Http\Controllers\backEnd\Dashbord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Patien;

class patientController extends Controller
{
    public function index(){
        try{                           
            $patients = Patien::get(['id','image','firstName','lastName','birthDate','email','gender']);
            return view('backEnd.dashbord.patients.index',compact('patients'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error',$ex->getMessage()]);
        }
    }

    public function destroy(Request $request){
        try{
            $patient = Patien::findOrFail($request->id);
            $patient->delete();
            return redirect()->back()->with(['errors' => 'patient deleted successfuly']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['errors' => $ex->getMessage()]);
        }
    }
}
