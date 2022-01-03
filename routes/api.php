<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\models\DoctorSpecailty;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['namespace'=>'API'],function(){
    Route::resource('/users','userController');
    Route::post('/users/register','userController@register')->name('register');
    Route::post('user/login','userController@login')->name('user.login');
    Route::get('user/basicDate','userController@getBasicDate');
    Route::get('check/phoneNumber','userController@checkPhoneNumber');
    Route::get('user/forgot/password','userController@userForgotPassword');
    Route::post('user/confirm/password','userController@userConfirmPassword');
    Route::get('patient/report','patientController@patientReport');
    /* analyzes routes */

    //Route::get('/analyzes/index','apiController@analyzesIndex');
    Route::get('/analyzes','apiController@analyzesIndex');
    Route::post('/analyzes/store','apiController@analyzesStore')->name('analyzes.store');
    Route::get('/analyzes/search','apiController@analyzesSearch');
    /* analyzes routes */
    /* rays routes */
    
    //Route::get('/rays/index','apiController@raysIndex');

    Route::get('/rays','apiController@raysIndex');
    Route::post('/rays/store','apiController@raysStore')->name('rays.store');
    Route::get('/rays/search','apiController@raysSearch');
    /* rays routes */
    
     // get all medication
    Route::get('medications','apiController@getAllMedication');

    // get all medication
    Route::get('medications','apiController@getAllMedication');

    /* routes app */
    Route::group(['prefix' => 'patientRegister'],function(){
        Route::post('/','patientController@register');
    });
    //patient
    Route::post('patient/updateOnline','patientController@updateOnline');
    Route::post('/patientRegister','patientController@register');
    Route::post('/patientLogin','patientController@login');
   // Route::post('/forgot-password', 'patientController@forgot_password');
    Route::get('/patients','patientController@getAll');
    Route::get('/patientSearch','patientController@searchId');
    Route::post('/patientBasicData/idCode','patientController@basicData');
    Route::get('/getPatientBasicData/idCode','patientController@getPatientData');
    Route::post('/updateBlood','patientController@updateBlood');
    Route::post('/patientMedication/idCode','patientController@medication');
    Route::get('/getPatientMedication/idCode','patientController@medicationGet');
    Route::delete('/patientMedication','patientController@medicationdelete');
    Route::post('/patientAllergi/idCode','patientController@allergiData');
    Route::get('/getPatientAllergi/idCode','patientController@allergiDataGet');
    Route::post('/patientDiseases/idCode','patientController@agreeNameData');
    Route::get('/patientDiseases/idCode','patientController@agreeNameGet');
    Route::post('/patientSurgery/idCode','patientController@surgeryData');
    Route::get('/patientSurgery/idCode','patientController@surgeryGet');
    // ptient mother
    Route::post('/patientMother/{idCode}','patientController@motherData');
    // patient mother
    Route::get('/patientMother/{idCode}','patientController@motherGet');
    // patient mother
    Route::post('/patientFather/{idCode}','patientController@fatherData');
    // patient father
    Route::get('/patientFather/{idCode?}','patientController@fatherGet');
    // patient father
    Route::post('/patientWife/{idCode}','patientController@WifeData');
    // patient wife
    Route::get('/patientWife/{idCode}','patientController@WifeGet');
    // patient Mother
    Route::post('/patientFemaleMother/{idCode}','patientController@femaleMotherData');
    // patient female mother
    Route::get('/patientFemaleMother/{idCode}','patientController@femaleMotherGet');
    // patient female mother
    Route::post('/patientPeriod/{idCode}','patientController@periodSwitch');
    Route::get('/patientPeriod/{idCode}','patientController@periodSwitchGet');
    Route::post('/doctor/switchOnline','DoctorController@switchOn');
    // Route::put('/patient/switchof/{idCode}','patientController@switchOf');
    Route::get('/patientSmoking/idCode','patientController@smokingGet');
    Route::post('/patientSmoking/idCode','patientController@smoking');
    Route::post('/patientCheckup/idCode','patientController@checkup');
    Route::get('/patientCheckup/idCode','patientController@checkupGet');
    Route::get('lastCheckup/{idCode?}','patientController@checkupGetLast');
    Route::delete('checkup','patientController@deleteCheckup');
    Route::post('/uploadFile','patientController@uploadFile');
    Route::post('/rocataFile','patientController@rocata_file');
    Route::get('/rocataFileGet','patientController@rocata_fileGet');
    Route::post('/raysFile','patientController@rays_file');
    Route::get('/raysFileGet','patientController@rays_fileGet');
    Route::post('/analzesFile','patientController@analzes_file');
    Route::get('/analzesFileGet','patientController@analzes_fileGet');
    Route::get('/patientPrescription/{idCode?}','patientController@raouchehsGet');
    Route::get('patient/forgot/password','patientController@forgotPassword');
    Route::post('patientForgotPassword','patientController@confirm_password');
    Route::post('/bloodDonorOn','patientController@DonorsBloodSwitch');
    Route::post('/bloodDonorOff','patientController@DonorsBloodSwitchOff');
    // Route::get('/bloodDonor/{blood}','patientController@getPatientBlood');
    Route::post('Blood','patientController@postDonor');
    Route::get('Blood','patientController@getDonor');
    Route::post('bloodRequest','patientController@donorRequest');
    Route::get('bloodRequest','patientController@getdonorRequest');
    Route::get('RequestsList','patientController@getdonorRequestList');
    Route::get('bloodAllRequests','patientController@decideRequestBlood');
    Route::post('donorAccept','patientController@donorAccept');
    Route::post('donorDecline','patientController@donorDecline');
    Route::get('bloodNearby/{blood}','patientController@index');
    Route::post('/deviceDonor','patientController@medicalDevice');
    Route::get('/myDeviceDonor','patientController@medicalDeviceGet');
    Route::get('deviceName','patientController@deviceSearchByName');
    Route::post('/deviceRequest','patientController@sendRequestDevice');
    Route::get('/allDevices','patientController@allDevice');
    Route::get('/requestsDevice','patientController@decideRequestdevice');
    Route::post('/deviceAccept','patientController@deviceAccept');
    Route::post('/deviceDecline','patientController@deviceDecline');
    Route::get('/myAcceptDevice','patientController@getMyAcceptDevice');
    Route::post('/deviceQuantity','patientController@updateQuantityDevice');
    Route::get('/myAllRequestDevice','patientController@getMyDeviceRequest');
    Route::post('/medicationDonor','patientController@medicationDonor');
    Route::get('/allMedication','patientController@getAllMedication');
    Route::get('/myDonorMedication','patientController@getMyDonorMedication');
    Route::get('/medicationDonor','patientController@medicationDonorGet');
    Route::post('/medicationRequest','patientController@medicationRequest');
    Route::post('/medicationAccept','patientController@medicationAccept');
    Route::post('/medicationDecline','patientController@medicationDecline');
    Route::get('/requestsMedication','patientController@decideRequestMedication');
    Route::get('/myAcceptMedication','patientController@getMyAcceptMedication');
    Route::post('/updateQuantity','patientController@updateQuantity');
    Route::get('/myAllRequestMedication','patientController@getMyMedictionRequest');
    Route::post('/deleteMedication','patientController@deletemedicationDonor');
    Route::post('patientCar','patientController@patientCar');
    Route::get('patientCar','patientController@patientCarGet');
    Route::put('updateImage','patientController@updateImage');
    Route::put('updateIdcode','patientController@updateIdCode');
    Route::put('updateState','patientController@updateState');

    Route::post('covid ','patientController@pcrCovid');
    Route::post('covidVac ','patientController@vacCovid');
    Route::post('covidFrom','patientController@formCovid');
    Route::post('covidTo','patientController@toCovid');
    Route::post('patienPescription','patientController@prescription');

    //Doctor
    Route::post('/raouchehs','DoctorController@raouchehs');
    Route::get('/raouchehs','DoctorController@raouchehsGet');
    Route::post('/rayPatient','DoctorController@rayPatient');
    Route::post('/linkPatientRay','DoctorController@rayPatientUpdate');
    Route::get('/rayPatient','DoctorController@rayPatientGet');
    Route::get('/allPatientRay','DoctorController@rayAllPatientGet');
    Route::get('/lastPatientRay','DoctorController@rayLastPatientGet');
    Route::post('/testPatient','DoctorController@testPatient');
    Route::get('/testPatient','DoctorController@testPatientGet');
    Route::get('/allPatientTest','DoctorController@testPatientAllGet');
    Route::get('/lastPatientTest','DoctorController@testPatientLastGet');
    Route::post('/linkPatientTest','DoctorController@rayTestUpdate');
    Route::get('/getOnlineDoctor','DoctorController@getOnlineDoctor');
    Route::post('doctorForgotPassword/{idCode?}','DoctorController@confirm_password');
    Route::post('doctor/register','DoctorController@register');
    Route::post('doctorLogin','DoctorController@login');
    Route::get('doctor/sp',function(){
        try{
            $sp = DoctorSpecailty::select('id','name')
            ->get();
            if($sp->count() > 0){
                return response()->json([
                    'data' => $sp,
                    'message' => 'success message',
                    'status' => true,
                ]);
            }else{
                return response()->json([
                    'message' => 'faild message',
                    'status' => false
                ],400);
            }
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false,
            ],500);
        }
    });
    Route::get('doctor/searchPatient','DoctorController@searchPatient');
    Route::put('/doctor/switchon/{idCode}','DoctorController@switchOn');
    Route::put('/doctor/switchof/{idCode}','DoctorController@switchOf');
    Route::get('/doctorSearch','DoctorController@searchDoctor');
    Route::get('doctors','DoctorController@getAllDoctor');
    Route::post('/doctor', 'DoctorController@store');
    Route::post('/switchHomecare','DoctorController@switchIsHomecara');
    Route::get('/switchHomecare','DoctorController@switchIsHomecareGet');
    Route::get('/getDoctorsBySpeciality', 'DoctorController@index');
    Route::get('/getDoctorsByName', 'DoctorController@searchDoctorName');
    Route::get('/allDoctorName', 'DoctorController@allDoctorName');
    Route::get('/doctor', 'DoctorController@searchDoctorWork');
    Route::post('/doctorQr','DoctorController@QrDoctor');
    Route::get('/doctorQr','DoctorController@QrDoctorGet');
    Route::post('/booking','DoctorController@createBook');
    Route::get('/booking','DoctorController@createBookGet');
    Route::get('/bookingDoctor','DoctorController@doctorBook');
    Route::delete('deleteBooking','DoctorController@deleteBooking');
    Route::get('doctorAppointment','DoctorController@getAppoiment');
    Route::post('isAccept','DoctorController@isAccept');
    Route::delete('deleteAppointment','DoctorController@deleteAppoinment');
    Route::post('rateDoctor','DoctorController@postRate');
    //Route::get('totalRate','DoctorController@totalRate');
    Route::get('rateDoctor','DoctorController@getRate');
    Route::get('FamilyDoctorName','DoctorController@searchFamilyDoctorName');
    Route::post('requestFamilyDoctor','DoctorController@requestFamilyDoctor');
    Route::post('acceptFamilyDoctor','DoctorController@acceptFamilyDoctor');
    Route::get('requestFamilyDoctor','DoctorController@requestFamilyDoctorGet');
    Route::delete('declineFamilyDoctor','DoctorController@deleteRequestFamilyDoctor');
    Route::get('requestPatientFamilyDoctor','DoctorController@requestPatientFamilyDoctorGet');
    Route::get('getFamilyDoctor','DoctorController@getFamilyDoctor');
    Route::get('acceptPatientFamilyDoctor','DoctorController@getAllPatientRequest');
   Route::get('getHomecareDoctor','DoctorController@getHomecareDoctor');
    //children
    Route::post('/kidsRegister/{idCode?}','childrenController@Register');
    Route::get('/kidsRegister/{idCode?}','childrenController@RegisterGet');
    Route::post('/kidsBasicData/{idCode?}','childrenController@basicData');
    Route::get('/kidsBasicData/{idCode?}','childrenController@getChildrenData');
    Route::post('/kidsDisease/{idCode?}','childrenController@diseaseData');
    Route::get('/kidsDisease/{idCode?}','childrenController@diseaseGet');
    Route::post('/kidsSurgery/{idCode?}','childrenController@Surgeries');
    Route::get('/kidsSurgery/{idCode?}','childrenController@SurgeriesGet');
    Route::post('/kidsAllergy/{idCode?}','childrenController@allergy');
    Route::get('/kidsAllergy/{idCode?}','childrenController@allergyGet');
    Route::post('/kidsMedication/{idCode?}','childrenController@medecation');
    Route::get('/kidsMedication/{idCode?}','childrenController@medecationGet');
    Route::post('/kidsFatherdisease/{idCode?}','childrenController@fatherdisease');
    Route::get('/kidsFatherdisease/{idCode?}','childrenController@fatherdiseaseGet');
    Route::post('/kidsMotherdisease/{idCode?}','childrenController@motherdisease');
    Route::get('/kidsMotherdisease/{idCode?}','childrenController@motherdiseaseGet');
    Route::get('/kids/{idCode?}','childrenController@kidsGet');
    Route::post('/kidsVaccination/{idCode?}','childrenController@vaccinations');
    Route::get('/kidsVaccination/{idCode?}','childrenController@vaccinationsGet');
    Route::post('/kidsPrescription/{idCode?}','childrenController@rocataChildren');
    Route::get('/kidsPrescription/{idCode?}','childrenController@rocataChildrenGet');
    Route::get('/allKidsPrescription','childrenController@allRocataChildrenGet');
    Route::post('/kidsRay/{idCode?}','childrenController@rayChildren');
    Route::get('/kidsRay/{idCode?}','childrenController@rayChildrenGet');
    Route::get('/allKidsRay','childrenController@allRayChildrenGet');
    Route::post('/kidsTest/{idCode?}','childrenController@testChildren');
    Route::get('/kidsTest/{idCode?}','childrenController@testChildrenGet');
    Route::get('/allKidsTest','childrenController@allTestChildrenGet');
    Route::post('/linkkidsRay','childrenController@rayChildrenUpdate');
    Route::post('/linkkidsTest','childrenController@testChildrenUpdate');
    Route::post('/requestCouples','childrenController@setCouples');
    Route::get('/requestCouples','childrenController@setCouplesGet');
    Route::get('/getAcceptRequest','childrenController@requestCouplesGet');
    Route::get('/strCouples','childrenController@getIdcodeCouples');
    Route::post('/Couples','childrenController@acceptCouples');
    Route::delete('/Couples','childrenController@declineCouples');
    Route::delete('/removeCouples','childrenController@removeCouples');
    //Hospital
    Route::post('/hospitalRegister','hospitalController@register');
    Route::post('/uploadImage','hospitalController@uploadImage');
    Route::get('/hospitals','hospitalController@getAll');
    Route::post('/hospitalLogin','hospitalController@login');
    Route::get('/hospitalSearch','hospitalController@searchHospital');
    Route::post('hosptailForgotPassword/{idCode?}','hospitalController@confirm_password');
    Route::post('addDoctor','hospitalController@isHospital');
    Route::get('hospitalDoctors','hospitalController@getAllDoctor');
    Route::post('updateDoctor','hospitalController@updateDoctor');
    Route::get('updateDoctor','hospitalController@getUpdateDoctor');
    Route::get('doctorHospital','hospitalController@hospitalGetDoctor');
    //Xray
    Route::post('/xrayRegister','xrayController@register');
    Route::get('/xrays','xrayController@xrayGetAll');
    Route::get('/xraySearch','xrayController@searchXray');
    Route::post('/xrayLab','xrayController@switchIsLab');
    Route::get('/xrayLab','xrayController@switchIsLabGet');
    Route::post('/xrayLogin','xrayController@login');
    Route::post('xrayForgotPassword/{idCode?}','xrayController@confirm_password');
    Route::get('/getXrayNearest', 'xrayController@index');
    Route::post('/xrayQr','xrayController@QrXray');
    Route::get('/xrayQr','xrayController@QrXrayGet');
    Route::post('xrayWork','xrayController@workOut');
    Route::get('xrayWork','xrayController@getwork');
    Route::delete('deleteAppointmentX','xrayController@deleteAppoinment');
    Route::post('rateXray','xrayController@postRate');
    Route::get('rateXray','xrayController@getRate');

    Route::post('patientRoucheta','xrayController@patientRoucheta');
    Route::get('patientRoucheta','labController@patientRouchetaget');
    Route::get('patientRouchetalab','labController@patientRouchetagetlab');
    //clinic
    Route::post('/clinicRegister','clinicController@register');
    Route::get('/clinics','clinicController@labGetAll');
    Route::post('/clinicLogin','clinicController@login');
    Route::get('/clinicSearch','clinicController@searchClinic');
    Route::post('clinicForgotPassword/{idCode?}','clinicController@confirm_password');
    Route::post('doctorClinic','clinicController@doctorClinic');
    Route::post('doctorClinicUpdate','clinicController@updateDoctor');
    Route::get('doctorClinicUpdate','clinicController@getUpdateDoctor');
    Route::get('doctorClinic','clinicController@clinicGetDoctor');
    Route::get('allDoctorClinic','clinicController@getAllDoctorClinic');
    //Lab
    Route::post('/labRegister','labController@register');
    Route::get('/labs','labController@labGetAll');
    Route::post('/labLogin','labController@login');
    Route::get('/labSearch','labController@searchLab');
    Route::post('/labXray','labController@switchIsXray');
    Route::get('/labXray','labController@switchIsXrayGet');
    Route::post('labForgotPassword/{idCode?}','labController@confirm_password');
    Route::get('/getLabNearest', 'labController@index');
    Route::post('/labQr','labController@QrLab');
    Route::get('/labQr','labController@QrLabGet');
    Route::post('labWork','labController@workOut');
    Route::get('labWork','labController@getwork');
    Route::post('rateLab','labController@postRate');
    Route::get('rateLab','labController@getRate');
    Route::put('patientRoucheta','labController@patientRoucheta');
    //Pharmacy
    Route::post('/pharmacyRegister','pharmacyController@register');
    Route::get('/pharmacies','pharmacyController@pharmacyGetAll');
    Route::get('/pharmacySearch','pharmacyController@searchPharmacy');
    Route::post('/pharmacyLogin','pharmacyController@login');
    Route::post('pharmacyForgotPassword/{idCode?}','pharmacyController@confirm_password');
    Route::get('/getPharmacyNearest', 'pharmacyController@index');
    Route::post('/phramacyQr','pharmacyController@QrPharmacy');
    Route::get('/phramacyQr','pharmacyController@QrPharmacyGet');
    //Nurse
    Route::post('nurseRegister','nurseController@register');
    Route::post('nurseLogin','nurseController@login');
    Route::get('nurseSearch','nurseController@searchNurse');
    Route::put('/nurse/switchon','nurseController@switchOn');
    Route::put('/nurse/switchof','nurseController@switchOf');
    Route::post('nurseForgotPassword/{idCode?}','nurseController@confirm_password');
    Route::get('/getNurseNearest', 'nurseController@index');
    //favorite
    Route::post('/favoriteDoctor','favoriteController@addFavoriteDoctor');
    Route::post('/favoriteLab','favoriteController@addFavoriteLab');
    Route::post('/favoriteXray','favoriteController@addFavoriteXray');
    Route::post('/favoritePharmacy','favoriteController@addFavoritePharmacy');
    Route::post('/favoriteNurse','favoriteController@addFavoriteNurse');
    Route::get('/favorite','favoriteController@getFavorite');
    Route::get('/favoriteType','favoriteController@getPatientFavorite');
    Route::post('/favoriteDoctorDelete','favoriteController@deleteFavoriteDoctor');
    Route::post('/favoriteLabDelete','favoriteController@deleteFavoriteLab');
    Route::post('/favoriteXrayDelete','favoriteController@deleteFavoriteXray');
    Route::post('/favoritePharmacyDelete','favoriteController@deleteFavoritePharmacy');
    Route::post('/favoriteNurseDelete','favoriteController@deleteFavoriteNurse');
    //get banner image
    Route::get('/banner', 'favoriteController@getBanner');

    Route::post('efelate/register','patientController@efelate_post_Register')->name('efelate_post_Register');
    Route::post('doctor/update/patient/profile','DoctorController@doctorUpdatePatient');

    Route::get('patient/getBasicDate','patientController@getBasicDate');

    Route::post('patient/editProfile','patientController@editProfile');
    
    //get all kids
    Route::get('get/allKids','DoctorController@getAllKids');
    
    // doctor edit profile
    Route::get('doctor/editProfile','DoctorController@doctorEditProfile');

    /* routes app */


});
