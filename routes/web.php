<?php

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

Auth::routes();


Route::get('/', function () {
    return redirect()->route('login');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users', 'AdminController@index')->name('all-admins');
    Route::get('/users/create', 'AdminController@create')->name('create-admin');
    Route::post('/users', ['uses' => 'AdminController@store', 'as' => 'add-new-admin']);
    Route::get('/users/{user}/edit', ['uses' => 'AdminController@edit', 'as' => 'edit-admin']);
    Route::put('/users/{user}', ['uses' => 'AdminController@update', 'as' => 'update-admin']);

    Route::get('/staff', 'StaffController@index')->name('all-staff-members');
    Route::get('/staff/create', 'StaffController@create')->name('new-staff');
    Route::post('/staff', ['uses' => 'StaffController@store', 'as' => 'add-new-staff']);
    Route::get('/staff/{staff}',['uses' => 'StaffController@show', 'as' => 'show-staff']);
    Route::get('/staff/{staff}/edit',['uses' => 'StaffController@edit', 'as' => 'edit-staff']);
    Route::put('/staff/{staff}', ['uses' => 'StaffController@update', 'as' => 'edit-staff']);
    Route::delete('/staff/{staff}',['uses' => 'StaffController@delete', 'as' => 'delete-staff']);



    Route::get('create/{staff}/message', 'MessageController@createMessage')->name('email-staff');

    Route::get('/payslips/{staff}/create', ['uses' => 'PayslipController@create', 'as' => 'create-staff-payroll']);
    Route::post('/payslips', ['uses' => 'PayslipController@store', 'as' => 'store-staff-payroll']);
    Route::get('/payslips', 'PayslipController@index')->name('all-staff-members-payroll');



    Route::post('/send/message', 'MessageController@sendMessage')->name('send-staff-message');
    Route::get('send/{staff}/payroll/{payroll}', ['uses' => 'MessageController@sendStaffPayroll', 'as' => 'send-staff-payroll']);





});



