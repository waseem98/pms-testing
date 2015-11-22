<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('blade', function () {
    return view('child');
});

Route::get('/', function () {
    return view('Login.login');
});

Route::get('/login', 'log_in@show');

Route::post('/', 'Auth\AuthController@postLogin');

Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/dashboard', 'Patient_Controller@show_dashboard');

//  .... .... Start controlled route using midleware .... 
Route::get('/patient/visit/{diag}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@visit_detail'
]);
Route::get('/patient', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@show'
]);
Route::get('/patient/detail', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@patient_details'
]);
 
Route::get('/patient/list/{sortby}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@patient_list'
]);

Route::get('/patient/delete/{pa}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@destroy'
]);
Route::get('/patient/appointments', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@appointments'
]);

Route::get('/patient/appointments/{by1}', [
   'middleware' => 'auth',
   'uses' => 'Patient_Controller@appointment'
]);

Route::get('/searchPatient', [
    'middleware' => 'auth',
    'uses' => 'searchPatient@search'
]);

Route::post('/searchPatient', [
    'middleware' => 'auth',
    'uses' => 'searchPatient@show_search'
]);

Route::get('/patient/edit/{pa}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@edit'
]);
Route::get('/patient/addAppointment/{pa}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@addAppointment'
]);
Route::post('patient/addingAppointment', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@addingAppointment'
]);

Route::post('/patient', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@save_as'
]);

Route::get('Auth/AuthController', [
    'middleware' => 'auth',
    'uses' => 'Auth\AuthController@getLogout'
]);

Route::post('/patient/edit', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@edit_as'
]);

Route::get('/patient/deleteAppointment/{app}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@deleteAppointment'
]);

Route::get('/patient/editAppointment/{app}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@editAppointment'
]);


Route::get('/patient/edit/visit/{v_id}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@editVisit'
]);

Route::post('/patient/edit/visit/{v_id?}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@editVisit_save'
]);

Route::post('patient/editingAppointment', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@editingAppointment'
]);


Route::get('/patient/report/{by1?}/{by2?}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@get_report'
]);



Route::get('/patient/visit/delete/{v_id}', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@deleteVisit'
]);

Route::post('/patient/printView', [
    'middleware' => 'auth',
    'uses' => 'Patient_Controller@get_printView'
]);

