<?php
use App\models\Doctor;
use App\models\Branch;
use App\models\Medication2;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\SessionAuthPatient;

use function GuzzleHttp\json_decode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('indexRoute');
});
Route::get('/test','TestController@test');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/firebase-phone-authentication', 'HomeController@invcaptcha')->name('invcaptcha');
/* patient verify route */
Route::get('/test/verify/{id?}','firebaseController@index')->name('patient_verify');
Route::get('/verficationCode/{id?}','firebaseController@verifcationCode')->name('patient_verifcationCode');
Route::get('edit/verify/{id}','firebaseController@editverify')->name('editVerify');
Route::get('edit/verficationCode/{id}','firebaseController@editverifcationCode')->name('editverifcationCode');
/* patient verify route */

/* hosptail verify route */
Route::get('/hosptail/verify/{id?}','firebaseController@hosptail_verify')->name('hosptail_verify');
Route::get('/verficationCode/hosptail/{id?}','firebaseController@verifcationCodeHosptail')->name('hosptail_verifcationCode');
// edit hosptail profile
Route::get('edit/hosptail/verify/{id}','firebaseController@edithosptail_verify')->name('editHosptailVerify');
Route::get('edit/verficationCode/hosptail/{id}','firebaseController@editVerifcationCodeHosptail')->name('editVerifcationCodeHosptail');
/* hosptail verify route */

/* clinic verify route */
Route::get('/clinic/verify/{id?}','firebaseController@clinic_verify')->name('clinic_verify');
Route::get('/verficationCode/clinic/{id?}','firebaseController@verifcationCodeClinic')->name('clinic_verifcationCode');
/* clinic edit profile */
Route::get('edit/clinic/verify/{id}','firebaseController@editclinic_verify')->name('editClinicVerify');
Route::get('edit/verficationCode/clinic/{id}','firebaseController@editVerifcationCodeClinic')->name('editVerifcationCodeClinic');
/* clinic verify route */
/* xray verify route */

Route::get('/xray/verify/{id?}','firebaseController@xray_verify')->name('xray_verify');
Route::get('/verficationCode/xray/{id?}','firebaseController@verifcationCodeXray')->name('xray_verifcationCode');

/* xray edit profile */
Route::get('edit/xray/verify/{id}','firebaseController@editxray_verify')->name('editXrayVerify');
Route::get('edit/verficationCode/xray/{id}','firebaseController@editVerifcationCodeXray')->name('editVerifcationCodeXray');
/* xray verify route */

/* labs verify route */
Route::get('/labs/verify/{id?}','firebaseController@labs_verify')->name('labs_verify');
Route::get('/verficationCode/labs/{id?}','firebaseController@verifcationCodeLabs')->name('labs_verifcationCode');
/* lab edit profile */
Route::get('edit/lab/verify/{id}','firebaseController@editlab_verify')->name('editLabVerify');
Route::get('edit/verficationCode/lab/{id}','firebaseController@editVerifcationCodeLab')->name('editVerifcationCodeLab');
/* labs verify route */

/* pharmacy verify route */
Route::get('/pharmacy/verify/{id?}','firebaseController@pharmacy_verify')->name('pharmacy_verify');
Route::get('/verficationCode/pharmacy/{id?}','firebaseController@verifcationCodepharmacy')->name('pharmacy_verifcationCode');
/* pharmacy verify route */
/* pharmacy edit profile */
Route::get('edit/pharmacy/verify/{id}','firebaseController@editpharmacy_verify')->name('editPharmacyVerify');
Route::get('edit/verficationCode/pharmacy/{id}','firebaseController@editVerifcationCodepharmacy')->name('editVerifcationCodePharmacy');
/* doctor verify route */
Route::get('/doctor/verify/{id}/clinic/{clinic_id}','firebaseController@doctor_verify')->name('doctor_verify');
Route::get('/verficationCode/doctor/{id}/clinic/{clinic_id}','firebaseController@verifcationCodedoctor')->name('doctor_verifcationCode');

Route::get('/doctor/verify/{id}/hosptail/{hosptail_id}','firebaseController@doctor_hosptail_verify')->name('doctor_hosptail_verify');
Route::get('/verficationCode/doctor/{id}/hosptail/{hosptail_id}','firebaseController@verifcationCodedoctor_hosptail')->name('doctor_hosptail_verifcationCode');
/* doctor verify route */
/* online doctor verify route */
Route::get('/online_doctor/verify/{id?}','firebaseController@online_doctor_verify')->name('online_doctor_verify');
Route::get('/verficationCode/online_doctor/{id?}','firebaseController@verifcationCodeOnline')->name('verifcationCodeOnline');
// edit profile
Route::get('edit/online_doctor/verify/{id}','firebaseController@editOnline_doctor_verify')->name('editDoctorVerify');
Route::get('edit/verficationCode/online_doctor/{id}','firebaseController@editVerifcationCodeOnline')->name('editVerifcationCodeOnline');
/* online doctor verify route */

/* Nurse verify route */
Route::get('/nurse/verify/{id?}','firebaseController@nurse_verify')->name('nurse_verify');
Route::get('/verficationCode/nurse/{id?}','firebaseController@verifcationCodenurse')->name('verifcationCodenurse');
/* Nurse verify route */

/* doctor hosptail branch verify route */
Route::get('/doctor_hosptail_branch/verify/{id}/hosptail/{hosptail_id}/branch/{branch_id}','firebaseController@doctor_hosptail_branch_verify')->name('doctor_hosptail_branch_verify');
Route::get('/verficationCode/doctor_hosptail_branch/{id}/hosptail/{hosptail_id}/branch/{branch_id}','firebaseController@verifcationCodedoctor_hosptail_branch')->name('verifcationCodedoctor_hosptail_branch');
/* doctor hosptail branch verify route */

/* doctor clinic branch verify route */
Route::get('/doctor_clinic_branch/verify/{id}/clinic/{clinic_id}/branch/{branch_id}','firebaseController@doctor_clinic_branch_verify')->name('doctor_clinic_branch_verify');
Route::get('/verficationCode/doctor_clinic_branch/{id}/clinic/{clinic_id}/branch/{branch_id}','firebaseController@verifcationCodedoctor_clinic_branch')->name('verifcationCodedoctor_clinic_branch');
/* doctor clinic branch verify route */

// /* social media routes */
// Route::get('login/{provider}','socialController@redirectToProvider')->middleware('web');
// Route::get('login/{provider}/callback','socialController@handleProviderCallback')->middleware('web');
// /* social media routes */


/* forgot password routes */
/* patient forgot password routes */
Route::get('/patient/forgot/password/{id}','firebaseController@patient_password')->name('patient_password');
Route::post('/patient/forgot/password/{id}','firebaseController@post_patient_password')->name('post_patient_password');
Route::get('/patient/confirm/password/{id}','firebaseController@confirm_password')->name('get_confirm_password');
Route::post('/patient/post/confirm/password/{id}','firebaseController@patient_confirm_password')->name('patient_confirm_password');

/* patient forgot password routes */

/* hosptail forgot password routes */
Route::get('/hosptail/forgot/password/{id}','firebaseController@hosptail_password')->name('hosptail_password');
Route::post('/hosptail/forgot/password/{id}','firebaseController@post_hosptail_password')->name('post_hosptail_password');
Route::get('/hosptail/confirm/password/{id}','firebaseController@hosptail_confirm_password')->name('get_hosptail_confirm_password');
Route::post('/hosptail/confirm/password/{id}','firebaseController@post_hosptail_confirm_password')->name('post_hosptail_confirm_password');
/* hosptail forgot password routes */

/* clinic forgot password routes */
Route::get('/clinic/forgot/password/{id}','firebaseController@clinic_password')->name('clinic_password');
Route::post('/clinic/forgot/password/{id}','firebaseController@post_clinic_password')->name('post_clinic_password');
Route::get('/clinic/confirm/password/{id}','firebaseController@clinic_confirm_password')->name('get_clinic_confirm_password');
Route::post('/clinic/confirm/password/{id}','firebaseController@post_clinic_confirm_password')->name('post_clinic_confirm_password');
/* clinic forgot password routes */

/* xray forgot password routes */
Route::get('/xray/forgot/password/{id}','firebaseController@xray_password')->name('xray_password');
Route::post('/xray/forgot/password/{id}','firebaseController@post_xray_password')->name('post_xray_password');
Route::get('/xray/confirm/password/{id}','firebaseController@xray_confirm_password')->name('get_xray_confirm_password');
Route::post('/xray/confirm/password/{id}','firebaseController@post_xray_confirm_password')->name('post_xray_confirm_password');
/* xray forgot password routes */

/* patient forgot password routes */
Route::get('/labs/forgot/password/{id}','firebaseController@labs_password')->name('labs_password');
Route::post('/labs/forgot/password/{id}','firebaseController@post_labs_password')->name('post_labs_password');
Route::get('/labs/confirm/password/{id}','firebaseController@labs_confirm_password')->name('get_labs_confirm_password');
Route::post('/labs/confirm/password/{id}','firebaseController@post_labs_confirm_password')->name('post_labs_confirm_password');
/* patient forgot password routes */

/* patient forgot password routes */
Route::get('/pharmacy/forgot/password/{id}','firebaseController@pharmacy_password')->name('pharmacy_password');
Route::post('/pharmacy/forgot/password/{id}','firebaseController@post_pharmacy_password')->name('post_pharmacy_password');
Route::get('/pharmacy/confirm/password/{id}','firebaseController@pharmacy_confirm_password')->name('get_pharmacy_confirm_password');
Route::post('/pharmacy/confirm/password/{id}','firebaseController@post_pharmacy_confirm_password')->name('post_pharmacy_confirm_password');
/* doctor forgot password routes */
Route::get('/doctor/forgot/password/{id}','firebaseController@doctor_password')->name('doctor_password');
Route::post('/doctor/forgot/password/{id}','firebaseController@post_doctor_password')->name('post_doctor_password');
Route::get('/doctor/confirm/password/{id}','firebaseController@doctor_confirm_password')->name('get_doctor_confirm_password');
Route::post('/doctor/confirm/password/{id}','firebaseController@post_doctor_confirm_password')->name('post_doctor_confirm_password');
/* doctor forgot password routes */
/* forgot password routes */

/* welcome page */
/* social media routes */
Route::get('/auth/redirect/{provider}', 'socialController@redirect');
Route::get('/callback/{provider}', 'socialController@callback');
/* social media routes */

/* 5 pages */
Route::get('/clup/{account}/{id}','welcomeController@getClup')->name('getClup');
Route::get('/insurance/{account}/{id}','welcomeController@getInsurance')->name('getInsurance');
Route::get('/online/{account}/{id}','welcomeController@getOnline')->name('getOnline')->middleware([SessionAuthPatient::class]);
Route::get('/qr/{account}/{id}','welcomeController@getQr')->name('getOr');
Route::get('/share/{account}/{id}','welcomeController@getShare')->name('getShare');
/* 5 pages */
Route::get('privacy/policy/{account}/{id}','welcomeController@getPrivacy')->name('getPrivacy');
Route::get('privacy/policy','welcomeController@getPrivacyRegister')->name('getPrivacyRegister');

/* test exm route */
Route::get('/patient/{name}',function($name,Request $request){
    $patient = \App\models\Patien::where('name','LIKE','%' . $name .'%')->count();
    if($patient > 0){
        return response()->json([
            'data' => \App\models\Patien::where('name','LIKE','%' . $name .'%')->get(),
            'msg' => 'success'
        ]);
    }
    return response()->json([
        'msg' => 'faild',
    ]);
    // return $patient;
});

/* tests exm routes */

Route::get('/chat/{chat_id}/messages','ChatController@getMessages');
Route::post('/sendMessage','ChatController@sendMessage');

Route::get('/chat/nurse/{chat_id}/messages','ChatController@getNurseMessages');
Route::post('Nurse/sendMessage','ChatController@sendNurseMessage');


Route::post('get/medication2','ChatController@getMedication2')->name('getAllEmploye');
