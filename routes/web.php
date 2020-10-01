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


Route::post('/supplier-create','Admin\DashboardController@supplier_create');

Route::get('/', 'Admin\DashboardController@supplier_status');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
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

    Route::get('/admin.admin-manage-doctor', function () {
        return view('admin.admin-manage-doctor');
    });

    Route::get('/admin.admin-manage-patient', function () {
        return view('admin.admin-manage-patient');
    });

    Route::get('/admin.admin-manage-supplier', function () {
        return view('admin.admin-manage-supplier');
    });



    /*Admin Manage User Function */
    /*Admin Create User Function */
    Route::post('/user-create','Admin\DashboardController@user_create');
    /*Admin View User List Function */
    Route::get('/admin.admin-user-list', 'Admin\DashboardController@user_list');
    /*Admin Edit User Function */
    Route::get('/admin-modify-user-profile/{id}', 'Admin\DashboardController@user_edit');
    /*Admin Update User Function */
    Route::put('/admin-modify-user-profile-update/{id}','Admin\DashboardController@user_update');
    /*Admin Delete User Function */
    Route::delete('/user-delete/{id}','Admin\DashboardController@user_delete');



    /*Admin Manage Doctor Function */
    /*Admin View Doctor List Function */
    Route::get('/admin.admin-manage-doctor', 'Admin\DashboardController@doctor_list');
    /*Admin Edit Doctor Function */
    Route::get('/admin-modify-doctor-information/{id}', 'Admin\DashboardController@doctor_edit');
    /*Admin Update Doctor Function */
    Route::put('/admin-modify-doctor-information-update/{id}','Admin\DashboardController@doctor_update');
    /*Admin Delete Doctor Function */
    Route::delete('/doctor-delete/{id}','Admin\DashboardController@doctor_delete');



    /*Admin Manage Patient Function */
    /*Admin View Patient List Function */
    Route::get('/admin.admin-manage-patient', 'Admin\DashboardController@patient_list');
    /*Admin Edit Patient Function */
    Route::get('/admin-modify-patient-information/{id}', 'Admin\DashboardController@patient_edit');
    /*Admin Update Patient Function */
    Route::put('/admin-modify-patient-information-update/{id}','Admin\DashboardController@patient_update');
    /*Admin Delete Patient Function */
    Route::delete('/patient-delete/{id}','Admin\DashboardController@patient_delete');


    
    /*Admin Manage Supplier Function */
    /*Admin View Supplier List Function */
    Route::get('/admin.admin-manage-supplier', 'Admin\DashboardController@supplier_list');
    /*Admin Accept Supplier Function */
    Route::get('/admin-manage-supplier-status-accept/{id}','Admin\DashboardController@accept_status');
    /*Admin Decline Supplier List Function */
    Route::get('/admin-manage-supplier-status-decline/{id}','Admin\DashboardController@decline_status');

});



/*
|--------------------------------------------------------------------------
| Doctor Routes
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
    Route::get('/doctor-modify-personal-information/{id}', 'Doctor\DashboardController@doctor_edit');
    /*Update doctor Function */
    Route::put('/doctor-modify-personal-information-update/{id}','Doctor\DashboardController@doctor_update');



    /*Doctor Manage Patient Function */
    /*List patient Function */
    Route::get('/doctor.doctor-manage-patient', 'Doctor\DashboardController@patient_list');
    /*Create patient Function */
    Route::post('/patient-create','Doctor\DashboardController@patient_create');
    /*Edit patient Function */
    Route::get('/doctor-modify-patient-information/{id}', 'Doctor\DashboardController@patient_edit');
    /*Update patient Function */
    Route::put('/doctor-modify-patient-information-update/{id}','Doctor\DashboardController@patient_update');
    /*Delete patient Function */
    Route::delete('/doctor_delete_patient_information/{id}','Doctor\DashboardController@patient_delete');
    /*List patient details Function */
    Route::get('/doctor-view-patient-information/{id}', 'Doctor\DashboardController@patient_information');



    /*Doctor Manage Health Index Function */
    /*Manage patient helth index list Function */
    Route::get('/doctor.doctor-manage-health-index', 'Doctor\DashboardController@patient_health_record');
    /*Manage patient helth index list Function */
    Route::get('/doctor-view-patient-health-index/{id}', 'Doctor\DashboardController@patient_health_record_details');



    /*Doctor Manage Advice Function */
    /*Edit Advice Function */
    Route::get('/doctor-modify-advice/{id}', 'Doctor\DashboardController@doctor_update_advice');    
    /*Update Advice Function */
    Route::put('/doctor-modify-advice-update/{id}','Doctor\DashboardController@advice_update');
});




/*
|--------------------------------------------------------------------------
| Patient Routes
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

    Route::get('/patient.patient-view-supplier-information', function () {
        return view('patient.patient-view-supplier-information');
    });

    /*Patient Function */
    /*Patient Edit Personal Information Function */
    Route::get('/patient-modify-personal-information/{id}', 'Patient\DashboardController@patient_edit');
    /*Patient Update Personal Information Function */
    Route::put('/patient-modify-personal-information-update/{id}','Patient\DashboardController@patient_update');



    /*Patient Create Personal Health Index Function */
    Route::post('/create-health-index','Patient\DashboardController@create_health_index');
    /*Patient Manage Personal Health Index Function */
    Route::get('/patient.patient-manage-health-index', 'Patient\DashboardController@health_index_record');
    /*Patient Edit Personal Health Index Function */
    Route::get('/patient-modify-health-index/{id}', 'Patient\DashboardController@health_index_edit');
    /*Patient Update Personal Health Index Function */
    Route::put('/patient-modify-health-index-update/{id}','Patient\DashboardController@health_index_update');
    


    /*Patient Manage Advice Function */
    Route::get('/patient.patient-manage-advice', 'Patient\DashboardController@advice_record');

    Route::get('/live_search', 'LiveSearch@index');
    Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
});
