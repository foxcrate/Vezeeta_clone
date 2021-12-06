<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Faviorate;
use App\models\Patien;
use App\models\Xray;
use App\models\Lab;
use App\models\Nurse;
use App\models\Banner;
use App\models\Pharmacy;
use App\models\OnlineDoctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class favoriteController extends Controller
{

  public function addFavoriteDoctor(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $doctor = OnlineDoctor::where('idCode', $request -> idDoctor) -> first();
      if ($doctor) {
              $faviorate = Faviorate::create([
                  'idCode' => $request -> idDoctor,
                  'name' => $request -> name,
                  'address' => $request -> address,
                  'latitude' => $request -> latitude,
                  'longitude' => $request -> longitude,
                  'type' => $request -> type,
                  'doctor_id' => $doctor -> id,
                  'patient_id' => $patient -> id,
                  'image' => $doctor->image,
                  'phoneNumber' => $doctor->phoneNumber,
              ]);
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild']);
  }
  public function addFavoriteXray(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $xray = Xray::where('idCode', $request -> idXray) -> first();
          if ($xray) {
              $faviorate = Faviorate::create([
                  'idCode' => $request -> idXray,
                  'name' => $request -> name,
                  'address' => $request -> address,
                  'latitude' => $request -> latitude,
                  'longitude' => $request -> longitude,
                  'type' => $request -> type,
                  'xray_id' => $xray -> id,
                  'patient_id' => $patient -> id,
                  'image' => $xray->image,
                  'phoneNumber' => $xray->phoneNumber,
              ]);
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild']);
  }
  public function addFavoriteLab(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $lab = Lab::where('idCode', $request -> idLab) -> first();
          if ($lab) {
              $faviorate = Faviorate::create([
                  'idCode' => $request -> idLab,
                  'name' => $request -> name,
                  'address' => $request -> address,
                  'latitude' => $request -> latitude,
                  'longitude' => $request -> longitude,
                  'type' => $request -> type,
                  'lab_id' => $lab -> id,
                  'patient_id' => $patient -> id,
                  'image' => $lab->image,
                  'phoneNumber' => $lab->phoneNumber,
              ]);
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild']);
  }
  public function addFavoritePharmacy(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $pharmacy = Pharmacy::where('idCode', $request -> idPharmacy) -> first();
          if ($pharmacy) {
              $faviorate = Faviorate::create([
                  'idCode' => $request -> idPharmacy,
                  'name' => $request -> name,
                  'address' => $request -> address,
                  'latitude' => $request -> latitude,
                  'longitude' => $request -> longitude,
                  'type' => $request -> type,
                  'pharmacy_id' => $pharmacy -> id,
                  'patient_id' => $patient -> id,
                  'image' => $pharmacy->image,
                  'phoneNumber' => $pharmacy->phoneNumber,
              ]);
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild']);
  }
  public function addFavoriteNurse(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $pharmacy = Nurse::where('idCode', $request -> idNurse) -> first();
          if ($pharmacy) {
              $faviorate = Faviorate::create([
                  'idCode' => $request -> idNurse,
                  'name' => $request -> name,
                  'address' => $request -> address,
                  'latitude' => $request -> latitude,
                  'longitude' => $request -> longitude,
                  'type' => $request -> type,
                  'nurse_id' => $pharmacy -> id,
                  'patient_id' => $patient -> id,
                  'image' => $pharmacy->image,
                  'phoneNumber' => $pharmacy->phoneNumber,
              ]);
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild']);
  }
  public function getFavorite(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
          $faviorate = Faviorate::where('patient_id', $patient -> id) -> count();
          if ($faviorate) {
              $faviorates = Faviorate::where('patient_id', $patient -> id) -> get();
              return response() -> json([
                  'data' => $faviorates,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild']);
  }
  public function getPatientFavorite(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $type = Faviorate::where('type', $request -> type)
      -> where('patient_id', $patient -> id)-> count();
          if ($type) {
              $favorite = Faviorate::where('type', $request -> type)
              ->where('patient_id', $patient -> id)  -> get();
              return response() -> json([
                  'data' => $favorite,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'failed']);
  }
  public function deleteFavoriteDoctor(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $doctor = OnlineDoctor::where('idCode', $request -> idDoctor) -> first();
          if ($doctor) {
              $faviorate = Faviorate::where('patient_id', $patient->id)->where(
                  'doctor_id',
                  $doctor -> id
              ) -> delete();
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild']);
  }
  public function deleteFavoriteLab(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $doctor = Lab::where('idCode', $request -> idLab) -> first();
          if ($doctor) {
              $faviorate = Faviorate::where('patient_id', $patient -> id) -> where(
                  'lab_id',
                  $doctor -> id
              ) -> delete();
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild']);
  }
  public function deleteFavoriteXray(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $doctor = Xray::where('idCode', $request -> idXray) -> first();
          if ($doctor) {
              $faviorate = Faviorate::where('patient_id', $patient -> id) -> where(
                  'xray_id',
                  $doctor -> id
              ) -> delete();
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild',400]);
  }
  public function deleteFavoritePharmacy(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $doctor = Pharmacy::where('idCode', $request -> idPharmacy) -> first();
          if ($doctor) {
              $faviorate = Faviorate::where('patient_id', $patient -> id) -> where(
                  'pharmacy_id',
                  $doctor -> id
              ) -> delete();
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild',400]);
  }
  public function deleteFavoriteNurse(Request $request) {
      $patient = Patien::where('idCode', $request -> idCode) -> first();
      if ($patient) {
      $doctor = Nurse::where('idCode', $request -> idNurse) -> first();
      if ($doctor) {
              $faviorate = Faviorate::where('patient_id', $patient -> id) -> where(
                  'nurse_id',
                  $doctor -> id
              ) -> delete();
              return response() -> json([
                  'data' => $faviorate,
                  'message' => 'success'
              ]);
          }
      }
      return response() -> json(['message' => 'faild'],400);
  }
  public function getBanner(){
    $banners = Banner::count();
    if ($banners){
        $banner = Banner::paginate(20);
        return response([
            'data' => $banner ,
            'message' => 'success'], 200);
        }else{
            return response(['message' => 'failed']);
        }
}
  }
