<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\backEnd\Dashbord\patientController;

// dashbord routes
Route::group(['prefix' => 'adminPanel','middleware' => 'web'],function(){
    Route::get('login','adminPanelController@login')->name('adminPanel.login');
    Route::post('login','adminPanelController@postLogin')->name('adminPanel.postlogin');
    Route::get('/','adminPanelController@homepage')->name('adminPanel.homepage');
    Route::get('logout','adminPanelController@logout')->name('adminPanel.logout');

    Route::resource('patients','patientController');
    Route::resource('doctors', 'doctorController');
    // route(dd(this));
});

// route when user auth:admin
Route::group(['prefix' => 'adminPanel','middleware' => 'auth:admin'],function(){

});
?>
