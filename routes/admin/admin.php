<?php
use App\models\Doctor;
use App\models\OnlineDoctor;
use App\models\Patien;
use App\models\product;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Middleware\SessionAuthPatient;
use App\Http\Middleware\SessionAuthOnlineDoctor;

/* admin routes */
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['prefix'=>'dashbord','middleware' => 'web'],function(){
            /* reset password patient */
            Route::group(['namespace'=>'patient'],function(){
                Route::post('password/email','ForgotPasswordController@sendResetLinkEmail')->name('patient.password.email');
                Route::get('password/reset','ForgotPasswordController@showLinkRequestForm')->name('patient.password.request');
                Route::post('password/reset','ResetPasswordController@reset');
                Route::get('password/reset/{token?}','ResetPasswordController@showResetForm')->name('patient.password.reset');
            });
            /* reset password patient */
            /* 3 pages */
            Route::get('/Insurance','backEndController@Insurance')->name('Insurance.page');
            Route::get('/online','backEndController@online')->name('online.page');
            Route::get('/finder/patient/{id}','backEndController@finder')->name('finder.page');
            /* 3 pages */

            //test
            //test

            /* finder routes */
            // Route::group(['prefix' => 'finder'],function(){
            //     Route::get('pharmacy/patient/{id}','finderController@getPharmacy')->name('finder.pharmacy');
            //     Route::get('xray/patient/{id}','finderController@getXray')->name('finder.xray');
            //     Route::get('lab/patient/{id}','finderController@getLab')->name('finder.lab');
            //     Route::get('doctor/patient/{id}','finderController@getDoctor')->name('finder.doctor');
            //     Route::get('nurse/patient/{id}','finderController@getNurse')->name('finder.nurse');
            //     Route::get('patient/{id}/get_appointments/doctor/{doctor_id}','finderController@get_appointments')->name('finder.get_appointments');
            //     Route::get('patient/{id}/search/doctor','finderController@search_doctor')->name('finder_search_doctor');
            //     Route::post('patient/{patient_id}/doctor/appoiments/book/{id}','finderController@book')->name('doctor.book');
            //     Route::get('patient/{patient_id}/doctor/show/appoiments/book/{id}/doctor_scudule/{sucdule_id}','finderController@show_book')->name('finder.show.book');
            //     Route::post('patient/{patient_id}/doctor/update/appoiments/book/{id}/doctor_scudule/{sucdule_id}','finderController@update_book')->name('finder.update.book');
            //     Route::get('patient/{id}/doctor/clinic','finderController@searchDoctorInClinic')->name('searchDoctorInClinic');
            //     Route::get('patient/{id}/doctor/hosptail','finderController@searchDoctorInHosptail')->name('searchDoctorInHosptail');
            // });



            Route::get('patien_id={id}/efelate',function($id){
                $efelatePatien = Patien::findOrFail($id);
                return view('backEnd.efelateRegister',compact('efelatePatien'));
            });
            Route::post('efelate/register/{id}','patienController@efelate_post_Register')->name('efelate_post_Register');
            /* add to faviorate */
            Route::post('patient/add_to_faviorate/nurse','finderController@add_to_faviorate_nurse')->name('add_to_faviorate_nurse');
            Route::post('patient/add_to_faviorate/doctor','finderController@add_to_faviorate_doctor')->name('add_to_faviorate_doctor');
            Route::post('patient/add_to_faviorate/pharmacy','finderController@add_to_faviorate_pharmacy')->name('add_to_faviorate_pharmacy');
            Route::post('patient/add_to_faviorate/xray','finderController@add_to_faviorate_xray')->name('add_to_faviorate_xray');
            Route::post('patient/add_to_faviorate/lab','finderController@add_to_faviorate_lab')->name('add_to_faviorate_lab');
            /* end finder routes */
            /* login and register */
            Route::get('/index','backEndController@index')->name('indexRoute');
            Route::get('/indexRegister','backEndController@indexRegister')->name('indexRegister');
            /* login and register */
            /* patient routes */
            Route::get('/patien/register','patienController@register')->name('patienRegister');
            Route::post('/patien/register','patienController@postRegister')->name('patien_post_Register');

            Route::middleware([SessionAuthPatient::class])->group(function ($id) {

                Route::get('patien/homepage/{id}','patienController@homepage')->name('patien.homepage');

                Route::post('patient/online_doctor/chat','patientRequest@patient_add_request')->name("patient_add_request");

                Route::get('/patien/logout','patienController@logout')->name('patien.logout');

                Route::group(['prefix' => 'finder'],function(){
                    Route::get('pharmacy/patient/{id}','finderController@getPharmacy')->name('finder.pharmacy');
                    Route::get('xray/patient/{id}','finderController@getXray')->name('finder.xray');
                    Route::get('lab/patient/{id}','finderController@getLab')->name('finder.lab');
                    Route::get('doctor/patient/{id}','finderController@getDoctor')->name('finder.doctor');
                    Route::get('nurse/patient/{id}','finderController@getNurse')->name('finder.nurse');
                    Route::get('patient/{id}/get_appointments/doctor/{doctor_id}','finderController@get_appointments')->name('finder.get_appointments');
                    Route::get('patient/{id}/search/doctor','finderController@search_doctor')->name('finder_search_doctor');
                    Route::post('patient/{id}/doctor/appoiments/book/{doctor_id}','finderController@book')->name('doctor.book');
                    Route::get('patient/{id}/doctor/show/appoiments/book/{doctor_id}/doctor_scudule/{sucdule_id}','finderController@show_book')->name('finder.show.book');
                    Route::post('patient/{id}/doctor/update/appoiments/book/{doctor_id}/doctor_scudule/{sucdule_id}','finderController@update_book')->name('finder.update.book');
                    Route::get('patient/{id}/doctor/clinic','finderController@searchDoctorInClinic')->name('searchDoctorInClinic');
                    Route::get('patient/{id}/doctor/hosptail','finderController@searchDoctorInHosptail')->name('searchDoctorInHosptail');
                });

                Route::get("patient/{id}/primary_special/{special_id}/doctors",'onlineDoctorController@showDoctors')->name("showDoctors");
                Route::get("patient/{id}/show_profile_doctor/{doctor_id}/",'onlineDoctorController@show_profile_doctor')->name("show_profile_doctor");

                // donate routes //
                Route::group(['prefix' => 'donate'], function () {
                    Route::get('/{id}','donateController@index')->name('donate.index');
                    Route::post('/{id}/addMedication','donateController@addMediction')->name('donate.addMedication');
                    Route::post('/{id}/addMedicalDevices','donateController@addMedicalDevices')->name('donate.addMedicalDevices');
                    Route::post('store','donateController@donateStore')->name('donate.store');
                    Route::get('donor/search/{id}','donateController@donor_search_blood')->name('donor_search_blood');
                    Route::post('addRequestDonor','donateController@addRequestDonor')->name('addRequestDonor');
                    Route::post('acceptRequestDonor','donateController@acceptRequestDonor')->name('acceptRequestDonor');
                    Route::post('declineRequestDonor','donateController@declineRequestDonor')->name('declineRequestDonor');
                    Route::get('search/Device','donateController@searchDevice')->name('searchDevice');
                    Route::get('get/Device/{id}','donateController@getDevice')->name('getDevice');
                    Route::post('AddRequestDevice','donateController@AddRequestDevice')->name('AddRequestDevice');
                    Route::get('search/Medication','donateController@searchMedication')->name('searchMedication');
                    Route::get('get/Medication/{id}','donateController@getMedication')->name('getMedication');
                    Route::post('AddRequestMedication','donateController@AddRequestMedication')->name('AddRequestMedication');
                    Route::post('AcceptRequestMedication','donateController@AcceptRequestMedication')->name('AcceptRequestMedication');
                    Route::post('DeclineRequestMedication','donateController@DeclineRequestMedication')->name('DeclineRequestMedication');
                    Route::post('AddRequestDevice','donateController@AddRequestDevice')->name('AddRequestDevice');
                    Route::post('AcceptRequestDevice','donateController@AcceptRequestDevice')->name('AcceptRequestDevice');
                    Route::post('DeclineRequestDevice','donateController@DeclineRequestDevice')->name('DeclineRequestDevice');
                });
                // donate routes //

                /* homecare routes */
                Route::group(['prefix'=> 'homecare'],function(){
                    Route::get('/{id}','patienController@index')->name('homecare.index');
                    Route::get('patientCars/{id}','patienController@patientCars')->name('homecare.patientCars');
                    Route::post('patientCars/{id}','patienController@postPatientCars')->name('homecare.post.patientCars');
                    Route::get('patient/{id}','patienController@getHomecare')->name('patient.homecare');
                    Route::get("patient/{id}/primary_special/{special_id}/doctors",'patienController@showDoctorsHomecare')->name("homecare.showDoctors");
                    Route::get("patient/{id}/homecare/show_profile_doctor/{doctor_id}/",'patienController@homecare_show_profile_doctor')->name("homecare_show_profile_doctor");
                    Route::post('patient/add_request','homecareController@addRequest')->name('patient.homecare.addRequest');
                    Route::post('patient/accept_request','homecareController@acceptRequest')->name('patient.homecare.acceptRequest');
                    Route::post('patient/decline_request','homecareController@declineRequest')->name('patient.homecare.declineRequest');
                    Route::get('patient/{id}/patientSearchNurse','homecareController@patientSearchNurse')->name('homecare.patientSearchNurse');
                    Route::post('nurse/{id}/search-nurse','homecareController@searchNurse')->name('searchNurse');
                });
                /* homecare routes */

                 /* child routes */
                Route::get('/patien/{id}/child','childController@getKids')->name('patients.kids');
                Route::post('/patient/{id}/create_child','childController@create_child')->name('patient.child.create');
                Route::get('/patient/{id}/profile/child/{child_id}','childController@profile')->name('patient.child.profile');
                Route::get('/patient/{id}/edit/profile/child/{child_id}','childController@editProfile')->name('patient.child.editProfile');
                Route::get('/patient/{id}/getAllChild','childController@getAllChild')->name('getAllChild');
                Route::post('/patient/{id}/update/child/profile/{child_id}','childController@updaeProfile')->name('patient.child.updaeProfile');
                Route::get('patient/{id}/child/{child_id}/Vaccinations','childController@getVaccinations')->name('child.Vaccinations');
                Route::post('patient/{id}/child/{child_id}/Vaccinations/store','VaccinationController@StoreVaccination')->name('Vaccination.store');
                Route::get('patient/{id}/child/{child_id}/edit/Vaccinations/{Vaccination_id}','VaccinationController@EditVaccinations')->name('child.edit.Vaccinations');
                Route::post('patient/{id}/child/{child_id}/update/Vaccinations/{Vaccination_id}','VaccinationController@UpdateVaccination')->name('Vaccination.update');
                /* child routes */

                 /* checkup routes */
                Route::group(['prefix' => 'checkup'],function(){
                    Route::post('patient/{id}','patienController@Postcheckup')->name('patient.Postcheckup');
                    Route::get('patient/{id}/get','patienController@getCheckup')->name('patient.getCheckup');
                });
                /* checkup routes */

                /* favorite routes */
                Route::group(['prefix' => 'favorite'],function(){
                    Route::get('patient/{id}','patienController@getfavorite')->name('patient.favorite');
                    Route::get('patient/{id}/{type}','patienController@getfavoriteType')->name('patient.favorite.type');
                });
                /* favorite routes */

                /* covied */
                Route::group(['prefix' => 'covied'], function () {
                    Route::get('/{id}','coviedController@index')->name('covied.index');
                    Route::post('store','coviedController@store')->name('covied.store');
                    Route::get('coviedHistory/{idCode}','coviedController@coviedHistory')->name('coviedHistory');
                });
                /* covied */

                /* doctor family */
                Route::group(['prefix' => 'doctorFamily'], function () {
                    Route::get('/{id}','doctorFamilyControlle@index')->name('doctorfamily.index');
                    Route::get('doctor/searchName','doctorFamilyControlle@searchDoctor')->name('searchDoctor');
                    Route::post('addRequestDoctor','doctorFamilyControlle@addRequestDoctor')->name('addRequestDoctor');
                    Route::post('acceptRequestDoctor','doctorFamilyControlle@acceptRequestDoctor')->name('acceptRequestDoctor');
                    Route::post('declineRequestDoctor','doctorFamilyControlle@declineRequestDoctor')->name('declineRequestDoctor');
                    Route::post('declinePatientRequest','doctorFamilyControlle@declinePatientRequest')->name('declinePatientRequest');
                });
                /* doctor family */

            });

            Route::get("online_doctor/register","onlineDoctorController@register")->name("onlineDoctorRegister");
            Route::post("online_doctor/register","onlineDoctorController@postRegister")->name("postonlineDoctorRegister");

            Route::middleware([SessionAuthOnlineDoctor::class])->group(function ($id) {

                Route::get('online_doctor/homepage/{id}','onlineDoctorController@homepage')->name('online_doctor.homepage');
                Route::get('/welcome/online_doctor/{id}','onlineDoctorController@welcome')->name('online_doctor.welcome');
                Route::get("online_doctor/profile/{id}","onlineDoctorController@profile")->name("online_doctor.profile");
                Route::get("online_doctor/logout",'onlineDoctorController@logout')->name("online_doctor.logout");
                // Route::get("patient/{id}/primary_special/{special_id}/doctors",'onlineDoctorController@showDoctors')->name("showDoctors");
                // Route::get("patient/{id}/show_profile_doctor/{doctor_id}/",'onlineDoctorController@show_profile_doctor')->name("show_profile_doctor");
                Route::get("online_doctor/edit/{id}","onlineDoctorController@edit")->name("online_doctor.edit");
                Route::post("online_doctor/update/{id}","onlineDoctorController@UpdateRegister")->name("online_doctor.update");
                Route::get("online_doctor/{id}/show_profile/patient/{patient_id}","onlineDoctorController@online_doctor_show_profile_patient")->name("online_doctor_show_profile_patient");
                Route::get("online_doctor/{id}/add_prescription/patient/{patient_id}","onlineDoctorController@add_prescription_patient")->name("add_prescription_patient");
                Route::post("online_doctor/{id}/post_add_prescription/patient/{patient_id}","onlineDoctorController@post_add_prescription_patient")->name("post_add_prescription_patient");
                Route::get("online_doctor/{id}/myWork",'onlineDoctorController@getMyWork')->name('online_doctor_get_myWork');
                // Route::get("online_doctor/{id}/add_myWork","onlineDoctorController@add_mywork")->name('online_doctor_add_mywork');
                Route::post('online_doctor/post_add_myWork',"onlineDoctorController@post_add_mywork")->name('post_add_mywork');
                Route::post('online_doctor/{id}/update_online','onlineDoctorController@update_online')->name('doctor_update_online');
                Route::post('online_doctor/{id}/update_homecare','onlineDoctorController@update_homecare')->name('doctor_update_homecare');
                Route::get('online_doctor/{id}/search/patient','onlineDoctorController@get_searchPatient')->name('get_doctor_search_patient');
                Route::get('online_doctor/{id}/post_search/patient','onlineDoctorController@post_searchPatient')->name('post_doctor_search_patient');
                Route::get('online_doctor/{id}/patient/{patient_id}/profile','onlineDoctorController@get_profile_patient')->name('doctor_profile_patient');
                Route::get('online_doctor/{id}/report/patien/{patient_id}','onlineDoctorController@reportPatien')->name('reportPatien');
                Route::get('doctor/{id}/show_profile/patient/{patient_id}','onlineDoctorController@show_profile_patient')->name('doctor_show_profile_patient');
                Route::get('doctor/schedules/{id}','onlineDoctorController@getDoctorSchedules')->name('get.doctor.schedules');
                Route::post('doctor/schedules/{id}/accept','onlineDoctorController@acceptSchedules')->name('doctor_acceptSchedules');
                Route::post('doctor/schedules/{id}/decline','onlineDoctorController@declineSchedules')->name('doctor_DeclineSchedules');
                Route::get('doctor/{id}/patient/{patient_id}/children','onlineDoctorController@doctor_all_children')->name('doctor_all_children');
                Route::get('doctor/{id}/patient/{patient_id}/child/profile/{child_id}','onlineDoctorController@doctor_show_profile_child')->name('doctor_show_profile_child');
                Route::get('doctor/{id}/patient/{patient_id}/child/{child_id}/add_prescription','onlineDoctorController@doctor_add_prescrption_child')->name('doctor_add_prescrption_child');
                Route::get('doctor/orders/{id}','onlineDoctorController@orders')->name('doctor.orders');
                Route::get('doctor/allPrescrption/{id}/patient/{patient_id}','onlineDoctorController@getAllPrescription')->name('doctor_getAllPrescription');
                Route::get('doctor/oldPrescrption/{id}/patient/{patient_id}','onlineDoctorController@getOldlPrescription')->name('doctor_getOldPrescription');
                Route::post('online_doctor_add_patient/{id}','onlineDoctorController@online_doctor_add_patient')->name('online_doctor_add_patient');
                Route::post('online_doctor/{id}/patient/{patient_id}','onlineDoctorController@doctorUpdatePatientProfile')->name('doctorUpdatePatientProfile');
                Route::get('analzes/doctor/{id}/{x_id}/patient/{patient_id}','onlineDoctorController@getAnalzes')->name('getAnalzesWhenRocata');
                Route::get('rays/doctor/{id}/{rocata_id}/patient/{patient_id}','onlineDoctorController@getRays')->name('getRaysWhenRocata');
                /* doctor online routes */
                /* patien add request */
                // Route::post('patient/online_doctor/chat','patientRequest@patient_add_request')->name("patient_add_request");

                Route::post("doctor/decline_request",'patientRequest@doctor_decline_request')->name("doctor_decline_request");
                Route::post("doctor/accept_request","patientRequest@doctor_accept_request")->name("doctor_accept_request");
                Route::get("doctor/{id}/profile_patient/{patient_id}/request/{request_id}/chat/{chat_id}","patientRequest@show_patient_profile")->name("show_patient_profile");
                Route::get("doctor/{id}/request/{request_id}","patientRequest@end_delete_request")->name("end_delete_request");

            });

            Route::group(['prefix' => 'club'], function () {
                Route::get('patient/{id}','clubController@patientClub')->name('patient.club')->middleware([SessionAuthPatient::class]);
                Route::get('doctor/{id}','clubController@doctorClub')->name('doctor.club')->middleware([SessionAuthOnlineDoctor::class]);
                Route::get('xray/{id}','clubController@xrayClub')->name('xray.club');
                Route::get('lab/{id}','clubController@labClub')->name('lab.club');
                Route::get('pharmacy/{id}','clubController@pharmacyClub')->name('pharmacy.club');
                Route::get('nurse/{id}','clubController@nurseClub')->name('nurse.club');
            });

            /* qr */
            Route::group(['prefix' => 'Qr'],function(){
                Route::get('/{id}','qrController@index')->name('patient.qr.index')->middleware([SessionAuthPatient::class]);
                Route::get('xray/{id}','qrController@xrayQr')->name('xray.qr.index');
                Route::get('lab/{id}','qrController@labQr')->name('lab.qr.index');
                Route::get('pharmacy/{id}','qrController@pharmacyQr')->name('pharmacy.qr.index');
                Route::get('doctor/{id}','qrController@doctorQr')->name('doctor.qr.index')->middleware([SessionAuthOnlineDoctor::class]);
                Route::get('nurse/{id}','qrController@nurseQr')->name('nurse.qr.index');
            });
            /* qr */

            Route::get('/welcome/patient/{id}','patienController@welcome')->name('patient.welcome')->middleware([SessionAuthPatient::class]);
            Route::get('/patien/profile/{id}','patienController@profile')->name('patien-profile')->middleware('is_patient')->middleware([SessionAuthPatient::class]);
            Route::get('/patien/edit/profile/{id}','patienController@editProfile')->name('edit.profile')->middleware('is_patient')->middleware([SessionAuthPatient::class]);
            Route::post('patien/update/profile/{id}','patienController@updateProfile')->name('update.profile');
            Route::get('patien/Getreport/{id}','patienController@getReport')->name('getReport')->middleware([SessionAuthPatient::class]);
            // new edit data profile //
            Route::get('patien/edit/data/profile/{id}','patienController@edit_data_profile')->name('edit_data_profile')->middleware([SessionAuthPatient::class]);
            Route::post('patien/update/data/profile/{id}/{profile_id}','patienController@update_data_profile')->name('updata_data_profile');
            // new edit data profile //
            // Route::get('/patien/logout','patienController@logout')->name('patien.logout');
            Route::get('/patien/edit/data/{id}','patienController@editData')->name('edit.data.profile')->middleware([SessionAuthPatient::class]);
            Route::put('/patien/update/data/{id}','patienController@updateData')->name('update.data.profile');
            Route::get('/patien/sendEmail/{id}','patienController@sendEmail')->name('patient_send_email')->middleware([SessionAuthPatient::class]);
            Route::get('/patien/verify/{id}','patienController@verifyPatient')->name('verifyPatient')->middleware([SessionAuthPatient::class]);
            Route::get('/verifyCode','backEndController@verify');
            Route::post('/verifyCode','backEndController@postVerify')->name('postVerify');
            Route::get('/ver','patienController@verfi');
            Route::get('/notifacation/patient/{id}/pescription/{rocata_id?}','patienController@notifyRocata')->name('notifyRocata');
            Route::get('/notifacation/patient/{id}/test/{test_id?}','patienController@notifyTest')->name('notifyTest');
            Route::get('/notifacation/patient/{id}/ray/{ray_id?}','patienController@notifyRay')->name('notifyRay');
            Route::get('notification/read','patienController@readNotify')->name('patient.readNotify');
            Route::get('patient/appointments/{id}','patienController@patient_Appointments')->name('patient_Appointments')->middleware([SessionAuthPatient::class]);
            Route::post('patient/addRate/doctor','patienController@addRateDoctor')->name('addRateDoctor');
            Route::post('patient/addRate/xray','patienController@addRateXray')->name('addRateXray');
            Route::post('patient/addRate/lab','patienController@addRateLab')->name('addRateLab');
            /* old pescription route */
            Route::get('/patien/old_pescription/{id}','patienController@getOldpescription')->name('get_old_pescription')->middleware([SessionAuthPatient::class]);
            Route::get('/patien/{type}/{id}/download/pdf','patienController@download_pdf')->name('download_pdf')->middleware([SessionAuthPatient::class]);
            Route::get('/patien/{type}/{id}/delete/files','patienController@deleteFiles')->name('deleteFiles')->middleware([SessionAuthPatient::class]);

            /* get and search wife */
            Route::get('patient/{id}/searchWife','patienController@searchWife')->name('patient.searchWife')->middleware([SessionAuthPatient::class]);
            Route::get('patient/searchWife','patienController@getWife')->name('getWife')->middleware([SessionAuthPatient::class]);
            Route::post('patient/{id}/addRequestWife','patienController@addRequestWife')->name('addRequestWife');
            Route::post('patient/acceptRequestWife','patienController@acceptRequestWife')->name('acceptRequestWife');
            Route::post('patient/declineRequestWife','patienController@declineRequestWife')->name('declineRequestWife');
            // show report wife or husband //
            Route::get('accept/report/patient/{id}','patienController@showReportAccept')->name('showReportAccept')->middleware([SessionAuthPatient::class]);
            // add wife or husband
            Route::post('addNew/wifeOrHusband','patienController@addNew_wifeOrHusband')->name('addNew_wifeOrHusband');





            Route::post('patient/{id}/update_online','patienController@patient_update_online')->name('patient_update_online');
            Route::post('patient/{id}/update_is_donor','donateController@patient_update_is_donor')->name('patient_update_is_donor');
            /* patient routes */
            /* clinic routes */
            Route::get('/clinic/register','clinicController@register')->name('clinicRegister');
            Route::post('/clinic/register','clinicController@postRegister')->name('clinic_post_Register');
            Route::get('clinic/homepage/{id}','clinicController@homepage')->name('clinic.homepage');
            Route::get('/welcome/clinic/{id}','clinicController@welcome')->name('clinic.welcome');
            Route::get('/clinic/edit/profile/{id}','clinicController@editProfile')->name('clinic.edit.profile')->middleware('is_clinic');
            Route::get('/clinic/profile/{id}','clinicController@profile')->name('clinic.profile')->middleware('is_Doctor_clinic');
            Route::get('/clinic/{id}/patien/{patien_id}','clinicController@clinic_get_patien_profile')->name('clinic_get_patien_profile');
            Route::get('/clinic/logout','clinicController@logout')->name('clinic.logout');
            Route::get('/clinic/{id}/docotr/{doctor_id}/patient/search','clinicController@search')->name('clinic.patient.search')->middleware('is_clinic');
            Route::put('/clinic/profile/{id}','clinicController@updateProfile')->name('clinic.update.profile');
            Route::post('/clinic/raoucata','clinicController@storeRaoucata')->name('store_clinic_Raoucata');
            Route::post('/clinic/add/analazes','clinicController@patient_clinic_add_analzes')->name('patient_clinic_add_analzes');
            Route::post('/clinic/add/rays','clinicController@patient_clinic_add_rays')->name('patient_clinic_add_rays');
            Route::get('/clinic/verify/{id}','clinicController@verifyClinic')->name('verifyClinic');
            Route::get('/clinic/sendEmail/{id}','clinicController@sendEmail')->name('clinic_send_email');
            Route::get('/clinic/as_doctor/{id}','clinicController@as_a_doctor')->name('clinic_as_doctor');
            Route::get('/clinic/as_doctor/{id}/labs','clinicController@get_search_lab')->name('clinic_get_search_lab');
            Route::get('/clinic/as_doctor_search/{id}/labs','clinicController@post_search_lab')->name('clinic_post_search_lab');
            Route::get('/clinic/as_doctor/{id}/xray','clinicController@get_search_xray')->name('clinic_get_search_xray');
            Route::get('/clinic/as_doctor_search/{id}/xray','clinicController@post_search_xray')->name('clinic_post_search_xray');
            Route::get('/clinic/as_doctor/{id}/pharmacy','clinicController@get_search_pharmacy')->name('clinic_get_search_pharmacy');
            Route::get('/clinic/as_doctor_search/{id}/pharmacy','clinicController@post_search_pharmacy')->name('clinic_post_search_pharmacy');
            Route::post('/clinic/{id}/add/doctor','clinicController@clinic_add_doctor')->name('clinic_add_doctor');
            Route::post("clinic/{id}/add/result/rays",'clinicController@clinic_addResult_rays')->name('clinic_add_Result_rays');
            Route::post("clinic/{id}/add/result/analzes",'clinicController@clinic_addResult_analzes')->name('clinic_add_Result_analzes');
            Route::post("clinic/{id}/add/result/child/rays",'clinicController@clinic_child_add_Result_rays')->name('clinic_child_add_Result_rays');
            Route::post("clinic/{id}/add/result/child/test",'clinicController@clinic_child_addResult_analzes')->name('clinic_child_add_Result_test');
            //Route::DELETE('/clinic/{id}/delete/doctor/{doctor_id}','clinicController@clinic_delete_doctor')->name('clinic_delete_doctor');

            Route::get('/clinic/{id}/login/doctor','clinicController@loginDoctor')->name('clinic_login_doctor');
            // Route::get('/clinic/{id}/login/doctor', function () {
            //     return "Alo";
            // })->name('clinic_login_doctor');

            Route::post('/clinic/{id}/login/doctor','clinicController@postDoctor')->name('clinic_post_doctor');
            Route::post('clinic/add/patient','clinicController@clinic_add_patien')->name('clinic_add_patien');
            Route::post('/clinic/{id}/add/branch','branchController@clinic_add_branch')->name('clinic_add_branch');
            Route::get('/clinic/{id}/patient/{patient_id}/allpescription','clinicController@clinic_getAllPrescription')->name('clinic_getAllPrescription');
            Route::get('/clinic/{id}/patient/{patien_id}/oldprescreption','clinicController@clinic_old_prescription')->name('clinic_old_prescription');
            Route::get('/clinic/doctor/{doctor_id}/logout',function($doctor_id){
                $doctor = Doctor::findOrFail($doctor_id);
                // $doctor->logout();
                 auth()->guard('doctor')->logout();
                return redirect()->route('clinic_login_doctor',auth()->guard('clinic')->user()->id);
            })->name('clinic_doctor.logout');
            Route::get('/clinic/{id}/patient/{patient_id}/children','childController@clinic_all_children')->name('clinic_all_children');
            Route::get('/clinic/{id}/patient/{patient_id}/child/profile/{child_id}','childController@clinic_child_profile')->name('clinic_child_profile');
            Route::get('/clinic/{id}/patient/{patient_id}/child/{child_id}/add_prescription','childController@child_add_prescription')->name('child_add_prescription');
            Route::post('child/addPrescription','childController@child_store_prescription')->name('child_store_prescription');
            Route::get('/clinic/{id}/patient/{patient_id}/child/{child_id}/old_prescrption','childController@child_old_prescrption')->name('child_old_prescrption');
            Route::get('/clinic/{id}/patient/{patient_id}/child/{child_id}/all_prescrption','childController@child_all_prescrption')->name('child_all_prescrption');
            Route::get('clinic/{id}/find/doctor','clinicController@clinicFindDoctor')->name('clinicFindDoctor');
            Route::post('clinic/appointmentsDoctor','clinicController@appointmentsDoctor')->name('clinic_appointmentsDoctor');
            Route::get('clinic/{id}/doctorAppoiement','clinicController@clinicdoctorAppoiement')->name('clinicdoctorAppoiement');
            Route::post('clinic/{id}/bookDoctorApp','clinicController@bookDocApp')->name('clinicBookDocApp');
            /* clinic routes */
            /* hosptail routes */
            Route::get('/hosptail/register','hosptailController@register')->name('hosptailRegister');
            Route::post('/hosptail/register','hosptailController@postRegister')->name('hosptail_post_Register');
            Route::get('hosptail/homepage/{id}','hosptailController@homepage')->name('hosptail.homepage');
            Route::get('/welcome/hosptail/{id}','hosptailController@welcome')->name('hosptail.welcome');
            Route::get('/hosptail/edit/profile/{id}','hosptailController@editProfile')->name('hosptail.edit.profile');
            Route::put('/hosptail/profile/{id}','hosptailController@updateProfile')->name('hosptail.update.profile');
            Route::get('/hosptail/profile/{id}','hosptailController@profile')->name('hosptail.profile')->middleware('is_Doctor');
            Route::get('/hosptail/{id}/patien/{patien_id}','hosptailController@hosptail_get_patien_profile')->name('hosptail_get_patien_profile');
            Route::get('/hosptail/logout','hosptailController@logout')->name('hosptail.logout');
            Route::get('/hosptail/{id}/doctor/{doctor_id}/patient/search','hosptailController@search')->name('hosptail.patient.search')->middleware('is_hosptail');
            Route::post('/hosptail/raoucata','hosptailController@storeRaoucata')->name('store_hosptail_Raoucata');
            Route::post('/hosptail/add/analazes','hosptailController@patient_hosptail_add_analzes')->name('patient_add_analzes');
            Route::post('/hosptail/add/rays','hosptailController@patient_hosptail_add_rays')->name('patient_add_rays');
            Route::get('/hosptail/verify/{id}','hosptailController@verifyhosptail')->name('verifyhosptail');
            Route::get('/hosptail/sendEmail/{id}','hosptailController@sendEmail')->name('hosptail_send_email');
            Route::get('/hosptail/as_doctor/{id}','hosptailController@as_a_doctor')->name('hosptail_as_doctor');
            Route::get('/hosptail/as_doctor/{id}/labs','hosptailController@get_search_lab')->name('get_search_lab');
            Route::get('/hosptail/as_doctor_search/{id}/labs','hosptailController@post_search_lab')->name('post_search_lab');
            Route::get('/hosptail/as_doctor/{id}/xray','hosptailController@get_search_xray')->name('get_search_xray');
            Route::get('/hosptail/as_doctor_search/{id}/xray','hosptailController@post_search_xray')->name('post_search_xray');
            Route::get('/hosptail/as_doctor/{id}/pharmacy','hosptailController@get_search_pharmacy')->name('get_search_pharmacy');
            Route::get('/hosptail/as_doctor_search/{id}/pharmacy','hosptailController@post_search_pharmacy')->name('post_search_pharmacy');
            Route::post('/hosptail/{id}/add/doctor','hosptailController@hosptail_add_doctor')->name('hosptail_add_doctor');
            Route::post("hosptail/{id}/add/result/rays",'hosptailController@addResult_rays')->name('add_Result_rays');
            Route::post("hosptail/{id}/add/result/analzes",'hosptailController@addResult_analzes')->name('add_Result_analzes');
            Route::post("hosptail/{id}/add/result/child/rays",'hosptailController@hosptail_child_add_Result_rays')->name('hosptail_child_add_Result_rays');
            Route::post("hosptail/{id}/add/result/child/test",'hosptailController@hosptail_child_addResult_analzes')->name('hosptail_child_add_Result_test');
            Route::get('/hosptail/{id}/login/doctor','hosptailController@loginDoctor')->name('loginDoctor');
            Route::post('/hosptail/{id}/login/doctor','hosptailController@post_loginDoctor')->name('post_loginDoctor');
            Route::get('/hosptail/{id}/delete/doctor/{doctor_id}','hosptailController@hosptail_delete_doctor')->name('hosptail_delete_doctor');
            Route::post('hosptail/add/patient','hosptailController@hosptail_add_patien')->name('hosptail_add_patien');
            Route::get('/hosptail/{id}/patient/{patien_id}/oldprescreption','hosptailController@hosptail_old_prescription')->name('hosptail_old_prescription');
            Route::post('/hosptail/{id}/add/branch','branchController@hosptail_add_branch')->name('hosptail_add_branch');
            Route::post('/hosptail/{id}/add/dapartement','hosptailController@hosptail_add_dapartement')->name('hosptail_add_dapartement');
            Route::get('/hosptail/doctor/{doctor_id}/logout',function($doctor_id){
                $doctor = Doctor::findOrFail($doctor_id);
                auth()->guard('doctor')->logout();
                return redirect()->route('loginDoctor',auth()->guard('hosptail')->user()->id);
            })->name('doctor.logout');
            Route::get('/hosptail/{id}/patient/{patient_id}/allPescription','hosptailController@getAllPrescription')->name('getAllPrescription');
            Route::get('hosptail/{id}/find/doctor','hosptailController@hosptailFindDoctor')->name('hosptailFindDoctor');
            Route::post('hosptail/appointmentsDoctor','hosptailController@appointmentsDoctor')->name('appointmentsDoctor');
            Route::get('hosptail/{id}/doctorAppoiement','hosptailController@hosptaildoctorAppoiement')->name('hosptaildoctorAppoiement');
            Route::post('hosptail/{id}/bookDoctorApp','hosptailController@bookDocApp')->name('bookDocApp');
            // Route::get('hosptail/{id}/showResultDoctor','hospitalController@showResultDoctor')->name('showResultDoctor');
            // branch route //
            // Route::get('/doctor/show','branchController@get_doctor_by_branch')->name('get_doctor_by_branch');
            // Route::get('hosptail/{id}/branch','hosptailController@hosptail_branch')->name('hosptail_branch');
            // Route::post('hosptail/{id}/login/branch','hosptailController@hosptail_login_branch')->name('hosptail_login_branch');
            // Route::get('hosptail/{id}/branch/{branch_id}','hosptailController@getAsBranch')->name('getAsBranch');
            // Route::get('hosptail/{id}/logout','branchController@logout')->name('branch.logout');
            // Route::get('hosptail/{id}/branch/{branch_id}/login/doctor','branchController@branch_login_doctor')->name('branch_login_doctor');
            // Route::post('/hosptail/{id}/branch/{branch_id}/login/doctor','branchController@branch_post_login_doctor')->name('branch_post_login_doctor');
            // Route::post('hosptail/{id}/branch/{branch_id}/add/doctor','branchController@branch_add_doctor')->name('branch_add_doctor');
            // Route::post('hosptail/{id}/branch/{branch_id}/add/patient','branchController@branch_add_patient')->name('branch_add_patient');
            // Route::get('hosptail/{id}/branch/{branch_id}/profile','branchController@branch_doctor_profile')->name('branch_doctor_profile');
            // Route::post('hosptail/{id}/branch/{branch_id}/add/departement','branchController@branch_doctor_departement')->name('branch_doctor_departement');
            // Route::get('/hosptail/branch/logout','branchController@branch_hosLogout')->name('hos_branch.logout');
            // branch route //
            Route::get('/hosptail/{id}/patient/{patient_id}/children','childController@hosptail_all_children')->name('hosptail_all_children');
            Route::get('/hosptail/{id}/patient/{patient_id}/child/profile/{child_id}','childController@hosptail_child_profile')->name('hosptail_child_profile');
            Route::get('/hosptail/{id}/patient/{patient_id}/child/{child_id}/add_prescription','childController@hosptail_child_add_prescrption')->name('hosptail_child_add_prescription');
            Route::post('/hosptail/child/addPrescription','childController@hosptail_child_store_prescription')->name('hosptail_child_store_prescription');
            Route::get('/hosptail/{id}/patient/{patient_id}/child/{child_id}/old_prescrption','childController@hosptail_child_old_prescrption')->name('hosptail_child_old_prescrption');
            Route::get('/hosptail/{id}/patient/{patient_id}/child/{child_id}/all_prescrption','childController@hosptail_child_all_prescrption')->name('hosptail_child_all_prescrption');
            /* hosptail routes */
            /* xray routes */
            Route::get('/xray/register','xrayController@register')->name('xrayRegister');
            Route::post('/xray/register','xrayController@postRegister')->name('xray_post_Register');
            Route::get('xray/homepage/{id}','xrayController@homepage')->name('xray.homepage');
            Route::get('/welcome/xray/{id}','xrayController@welcome')->name('xray.welcome');
            Route::get('/xray/profile/{id}','xrayController@profile')->name('xray.profile')->middleware('is_xray');
            Route::get('xray/edit/profile/{id}','xrayController@editProfile')->name('xray.edit.profile')->middleware('is_xray');
            Route::put('/xray/update/profile/{id}','xrayController@updateProfile')->name('xray.update.profile');
            Route::get('/xray/logout','xrayController@logout')->name('xray.logout');
            Route::get('/xray/{id}/patient/search','xrayController@search')->name('xray.patient.search')->middleware('is_xray');
            Route::get('/xray/verify/{id}','xrayController@verifyXray')->name('verifyXray');
            Route::get('/xray/sendEmail/{id}','xrayController@sendEmail')->name('xray_send_email');
            Route::post('/xray/add/result','xrayController@add_result_test')->name('add_result_test');
            Route::post("xray/{id}/add/result/child/test",'xrayController@xray_child_addResult_analzes')->name('xray_child_add_Result_test');
            Route::get('/xray/{id}/as_lab','xrayController@xray_as_lab')->name('xray_as_lab');
            // Route::post('/xray/{id}/add/patien','xrayController@xray_add_patien')->name('xray_add_patien');
            Route::post('/xray/{id}/add/branch','branchController@xray_add_branch')->name('xray_add_branch');
            Route::get('xray/{id}/mywork','xrayController@getMywork')->name('xray.mywork');
            Route::post('xray/postMywork','xrayController@postMywork')->name('xray.postMywork');
            Route::get('xray/orders/{id}','xrayController@orders')->name('xray.orders');
            Route::post('xray/{id}/addPatien','xrayController@xrayAddPatient')->name('xray_add_patient');
            // branch routes //
            Route::get('/xray/{id}/branch','xrayController@xray_branch')->name('xray_branch');
            Route::post('xray/{id}/login/branch','xrayController@xray_login_branch')->name('xray_login_branch');
            Route::get('xray/{id}/branch/{branch_id}','xrayController@Xray_getAsBranch')->name('Xray_getAsBranch');
            // bracnh routes //
            /* xray routes */
            /* labs routes */
            Route::get('/labs/register','labsController@register')->name('labsRegister');
            Route::post('/labs/register','labsController@postRegister')->name('labs_post_Register');
            Route::get('labs/homepage/{id}','labsController@homepage')->name('labs.homepage');
            Route::get('/welcome/lab/{id}','labsController@welcome')->name('labs.welcome');
            Route::get('/labs/edit/profile/{id}','labsController@editProfile')->name('labs.edit.profile')->middleware('is_lab');
            Route::put('/labs/update/profile/{id}','labsController@updateProfile')->name('labs.update.profile');
            Route::get('/labs/profile/{id}','labsController@profile')->name('labs.profile')->middleware('is_lab');
            Route::get('/labs/logout','labsController@logout')->name('labs.logout');
            Route::get('/labs/{id}/patient/search','labsController@search')->name('labs.patient.search')->middleware('is_lab');
            Route::get('/labs/verify/{id}','labsController@verifyLabs')->name('verifyLabs');
            Route::get('/labs/sendEmail/{id}','labsController@sendEmail')->name('labs_send_email');
            Route::post('/lab/add/result','labsController@add_result_ray')->name('add_result_ray');
            Route::post("lab/{id}/add/result/child/rays",'labsController@lab_child_add_Result_rays')->name('lab_child_add_Result_rays');
            Route::get('/labs/{id}/as_xray','labsController@labs_as_xray')->name('labs_as_xray');
            // Route::post('/labs/{id}/add/patien','labsController@labs_add_patien')->name('labs_add_patien');
            Route::post('/labs/{id}/add/branch','branchController@labs_add_branch')->name('labs_add_branch');
            Route::get('lab/{id}/mywork','labsController@getMywork')->name('lab.mywork');
            Route::post('lab/postMywork','labsController@postMywork')->name('lab.postMywork');
            Route::get('lab/orders/{id}','labsController@orders')->name('lab.orders');
            Route::post('lab/{id}/addPatien','labsController@labAddPatient')->name('lab_add_patient');
            // branch routes //
            Route::get('/labs/{id}/branch','labsController@labs_branch')->name('labs_branch');
            Route::post('labs/{id}/login/branch','labsController@labs_login_branch')->name('labs_login_branch');
            Route::get('labs/{id}/branch/{branch_id}','labsController@labs_getAsBranch')->name('labs_getAsBranch');
            // bracnh routes //
            /* labs routes */
            /* pharmacy routes */
            Route::get('/pharmacy/register','pharmacyController@register')->name('pharmacyRegister');
            Route::post('/pharmacy/register','pharmacyController@postRegister')->name('pharmacy_post_Register');
            Route::get('pharmacy/homepage/{id}','pharmacyController@homepage')->name('pharmacy.homepage');
            Route::get('/welcome/pharmacy/{id}','pharmacyController@welcome')->name('pharmacy.welcome');
            Route::get('/pharmacy/profile/{id}','pharmacyController@profile')->name('pharmacy.profile');
            Route::get('/pharmacy/edit/profile/{id}','pharmacyController@editProfile')->name('pharmacy.edit.profile');
            Route::put('/pharmacy/update/profile/{id}','pharmacyController@updateProfile')->name('pharmacy.update.profile');
            Route::get('/pharmacy/logout','pharmacyController@logout')->name('pharmacy.logout');
            Route::get('/pharmacy/{id}/patient/search','pharmacyController@search')->name('pharmacy.patient.search');
            Route::get('/pharmacy/verify/{id}','pharmacyController@verifyPharmacy')->name('verifyPharmacy');
            Route::get('/pharmacy/sendEmail/{id}','pharmacyController@sendEmail')->name('pharmacy_send_email');
            // Route::post('/pharmacy/{id}/add/patien','pharmacyController@pharmacy_add_patien')->name('pharmacy_add_patien');
            // Route::post('/pharmacy/{id}/add/branch','branchController@pharmacy_add_branch')->name('pharmacy_add_branch');
            Route::get('/pharmacy/orders/{id}','pharmacyController@orders')->name('pharmacy.orders');
            Route::post('pharmacy/{id}/addPatien','pharmacyController@pharmacy_add_patien')->name('pharmacy_add_patien');
            // branch routes //
            Route::get('/pharmacy/{id}/branch','pharmacyController@pharmacy_branch')->name('pharmacy_branch');
            Route::post('pharmacy/{id}/login/branch','pharmacyController@pharmacy_login_branch')->name('pharmacy_login_branch');
            Route::get('pharmacy/{id}/branch/{branch_id}','pharmacyController@pharmacy_getAsBranch')->name('pharmacy_getAsBranch');
            // bracnh routes //
            // Route::get('/pharmacy/{id}/patient/getroacata','pharmacyController@getLastRoacata')->name('get.last.roacata');
            /* pharmacy routes */
            /* doctor online routes */



            Route::get('patient/{id}/doctor/{doctor_id}','patientRequest@patient_chat_doctor')->name('patient_chat_doctor')->middleware([SessionAuthPatient::class]);

            /* patien add request */
            /*
            /* doctor routes */
            Route::get("doctor/{id}/clinic/{clinic_id}",'clinicController@welocmeDoctor')->name("clinic_welcome_doctor");
            Route::get('doctor/{id}/hosptail/{hosptail_id}','hosptailController@hosptail_welcome_doctor')->name("hosptail_welcome_doctor");
            Route::get('doctor/{id}/hosptail/{hosptail_id}/branch/{branch_id}','hosptailController@hosptail_branch_welcome_doctor')->name("hosptail_branch_welcome_doctor");
            Route::get('doctor/{id}/clinic/{clinic_id}/branch/{branch_id}','clinicController@clinic_branch_welcome_doctor')->name("clinic_branch_welcome_doctor");
            /* doctor routes */
            /* Nurce routes */
            Route::group(['prefix' => 'nurse'],function(){
                Route::get('register','nurseController@register')->name('nurce.register');
                Route::post('register/store','nurseController@postRegister')->name('nurse.postRegister');
                Route::get('welcome/{id}','nurseController@welcome')->name('nurse.welcome');
                Route::get('profile/{id}','nurseController@profile')->name('nurse.profile');
                Route::get('homepage/{id}','nurseController@homepage')->name('nurse.homepage');
                Route::get('edit/profile/{id}','nurseController@editProfile')->name('nurse.edit.profile');
                Route::get("patient/{id}/show_profile_nurse/{nurse_id}/",'nurseController@show_profile_nurse')->name("show_profile_nurse");
                Route::post('update/{id}','nurseController@updateProfile')->name('nurse.update.profile');
                Route::post('patient/nurse','patientRequest@nurse_add_request')->name("nurse_add_request");
                Route::post("decline_request",'patientRequest@nurse_decline_request')->name("nurse_decline_request");
                Route::post("accept_request","patientRequest@nurse_accept_request")->name("nurse_accept_request");
                Route::get("{id}/profile_patient/{patient_id}/request/{request_id}/chat/{chat_id}","patientRequest@nurse_show_patient_profile")->name("nurse_show_patient_profile");
                Route::get('patient/{id}/nurse/{nurse_id}','patientRequest@patient_chat_nurse')->name('patient_chat_nurse');
                Route::post("nurse/{nurse_id}/request/{id}","patientRequest@nurse_end_delete_request")->name("nurse_end_delete_request");
                Route::post('{id}/add/patien','nurseController@nurse_add_patien')->name('nurse_add_patient');
                Route::get('logout','nurseController@logout')->name('nurse.logout');
            });
            /* Nurce routes */
            /* login route */
            Route::post('/login','backEndController@login')->name('loginRoute');
            /* login route */
            /* check your email page */
            Route::get('/check/email','backEndController@checkEmail')->name('checkEmail');
            /* reset password */
            Route::get('/forgot/password','backEndController@forgotPassword')->name('forgot_password');
            Route::post('/forgot/password','backEndController@post_forgot_password')->name('post_forgot_password');
            Route::get('/update/password/{role}','backEndController@update_new_password')->name('update_new_password_page');
            Route::post('/update/password','backEndController@post_update_new_password')->name('post_update_new_password_page');
            // cancel function
            Route::get('cancel/{id}',function($id){
                $p = Patien::findOrFail($id);
                return redirect()->route('patien.homepage',$p->id);
            })->name('cancel');
            /* reset password */

            // test routes //
            Route::get('products',function(){
                $products = product::select(['id','name','price','currency'])->get();
                return view('product',compact('products'));
            });
            // test routes //
            /* route chat */
        });
    });


/* admin routes */



?>
