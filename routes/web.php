<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/supplier-create-personal-record', function () {

    return view('admin.supplier-create-personal-record');

});

Route::post('/supplier-create','Admin\DashboardController@suppliercreate');

Route::group(['middleware' => ['auth','admin']], function () {

    Route::get('/admin.admin-dashboard', function () {
        return view('admin.admin-dashboard');
    });

    Route::get('/admin.admin-user-list', function () {
        return view('admin.admin-user-list');
    });

    Route::get('/admin.admin-create-user', function () {
        return view('admin.admin-create-user');
    });

    Route::post('/user-create','Admin\DashboardController@usercreate');

    Route::get('/admin.admin-user-list', 'Admin\DashboardController@userlist');

    Route::get('/admin-modify-user-profile/{id}', 'Admin\DashboardController@useredit');

    Route::put('/admin-modify-user-profile-update/{id}','Admin\DashboardController@userupdate');

    Route::delete('/user-delete/{id}','Admin\DashboardController@userdelete');


});


/*
|--------------------------------------------------------------------------
| Doctor Login Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['auth','doctor']], function () {

    Route::get('/doctor.doctor-dashboard', function () {
        return view('doctor.doctor-dashboard');
    });

    Route::get('/doctor.doctor-manage-patient', function () {
        return view('doctor.doctor-manage-patient');
    });

    Route::get('/doctor.doctor-create-user', function () {
        return view('doctor.doctor-create-user');
    });

    Route::get('/doctor.doctor-manage-health-index', function () {
        return view('doctor.doctor-manage-health-index');
    });


    /*Doctor Function */
    /*Edit doctor Function */
    Route::get('/doctor-modify-personal-information/{id}', 'Doctor\DashboardController@doctoredit');
    /*Update doctor Function */
    Route::put('/doctor-modify-personal-information-update/{id}','Doctor\DashboardController@doctorupdate');


    /*Doctor Manage Patient Function */
    /*List patient Function */
    Route::get('/doctor.doctor-manage-patient', 'Doctor\DashboardController@patientlist');
    /*Create patient Function */
    Route::post('/patient-create','Doctor\DashboardController@patientcreate');
    /*Edit patient Function */
    Route::get('/doctor-modify-patient-information/{id}', 'Doctor\DashboardController@patientedit');
    /*Update patient Function */
    Route::put('/doctor-modify-patient-information-update/{id}','Doctor\DashboardController@patientupdate');
    /*Delete patient Function */
    Route::delete('/doctor_delete_patient_information/{id}','Doctor\DashboardController@patientdelete');
    /*List patient details Function */
    Route::get('/doctor-view-patient-information/{id}', 'Doctor\DashboardController@patientinformation');



    /*Doctor Manage Health Index Function */
    /*Manage patient helth index list Function */
    Route::get('/doctor.doctor-manage-health-index', 'Doctor\DashboardController@patienthealthrecord');
    /*Manage patient helth index list Function */
    Route::get('/doctor-view-patient-health-index/{id}', 'Doctor\DashboardController@patienthealthrecorddetails');


    /*Doctor Manage Advice Function */
    /*Edit Advice Function */
    Route::get('/doctor-modify-advice/{id}', 'Doctor\DashboardController@doctorupdateadvice');    
    /*Update Advice Function */
    Route::put('/doctor-modify-advice-update/{id}','Doctor\DashboardController@adviceupdate');
});

/*
|--------------------------------------------------------------------------
| Patient Login Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['auth','patient']], function () {

    Route::get('/patient.patient-dashboard', function () {
        return view('patient.patient-dashboard');
    });

    Route::get('/patient.patient-manage-health-index', function () {
        return view('patient.patient-manage-health-index');
    });

    Route::get('/patient.patient-create-health-index', function () {
        return view('patient.patient-create-health-index');
    });

    Route::get('/patient.patient-manage-advice', function () {
        return view('patient.patient-manage-advice');
    });

    Route::post('/create-health-index','Patient\DashboardController@createhealthindex');

    Route::get('/patient.patient-manage-health-index', 'Patient\DashboardController@healthindexrecord');
        
    Route::get('/patient-modify-health-index/{id}', 'Patient\DashboardController@healthindexedit');

    Route::put('/patient-modify-health-index-update/{id}','Patient\DashboardController@healthindexupdate');
    
    Route::get('/patient-modify-personal-information/{id}', 'Patient\DashboardController@patientedit');

    Route::put('/patient-modify-personal-information-update/{id}','Patient\DashboardController@patientupdate');



    Route::get('/patient.patient-manage-advice', 'Patient\DashboardController@advicerecord');


});
