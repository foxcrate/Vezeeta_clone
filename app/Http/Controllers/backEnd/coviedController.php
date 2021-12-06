<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backEnd\storeCovied;
use App\models\covidCountry;
use App\models\covidPcr;
use App\models\covidVac;
use App\models\Patien;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
class coviedController extends Controller
{
    public function index($id){
        try{
            $patient = Patien::findOrFail($id);
            return view('backEnd.covied.index',compact('patient'));
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }
    }
    public function store(storeCovied $request){
            try{
                $request_data = $request->all();
                DB::beginTransaction();
                Alert::success('Success', 'Covied Added Succesfuly');
                if($request->linkpcr){
                $hospitalRequest = $request->linkpcr;
                $image = $request->file('linkpcr');
                $input = $hospitalRequest = $image->getClientOriginalName();
                $destinationPath = public_path('uploads/');
                $image->move($destinationPath, $input);
                $request_data['linkpcr'] = asset('uploads/' . $input);
            }
            
            if($request->linkvac){
                $hospitalRequest = $request->linkvac;
                $image = $request->file('linkvac');
                $input = $hospitalRequest = $image->getClientOriginalName();
                $destinationPath = public_path('uploads/');
                $image->move($destinationPath, $input);
                $request_data['linkvac'] = asset('uploads/' . $input);
            }
                 // create new object covidCountry and save in database
                 $covidCountry= new covidCountry();
                 $covidCountry->from = $request->countryFrom;
                 $covidCountry->to = $request->countryTo;
                 $covidCountry->patient_id = $request->patient_id;
                 $covidCountry->save();
                 // create new object covidPcr and save in database
                 $covidPcr = new covidPcr();
                 $covidPcr->link=$request_data['linkpcr'];
                 $covidPcr->patient_id = $request->patient_id;
                 $covidPcr->save();
                 // create new object covidVac and save in database
                 $covidVac = new covidVac();
                 $covidVac->link=$request_data['linkvac'];
                 $covidVac->patient_id = $request->patient_id;
                 $covidVac->save();
                 DB::commit();
                 return redirect()->back();
            }catch(\Exception $ex){
                return $ex->getMessage();
            }
    }

    public function coviedHistory($idCode){
        try{
            $patient = Patien::with(['coviedCountry','coviedPcr','coviedVac'])->where('idCode',$idCode)->first();
            return view('backEnd.covied.coviedHistory',compact('patient'));
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'problem']);
        }

    }
}
