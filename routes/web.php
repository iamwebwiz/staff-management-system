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
    Route::get('/create/admin', 'AdminController@create')->name('create-admin');
    Route::post('add-new-admin', [
        'uses' => 'AdminController@store',
        'as' => 'add-new-admin',
        'middleware' => 'auth'
    ]);
    Route::get('/all/admins', 'AdminController@index')->name('all-admins');
    
    Route::get('/new-staff', 'StaffController@newStaff')->name('new-staff');
    Route::get('/all-staff-members', 'StaffController@allStaffMembers')->name('all-staff-members');
    Route::post('add-new-staff', [
        'uses' => 'StaffController@addNewStaff',
        'as' => 'add-new-staff',
        'middleware' => 'auth'
    ]);
    Route::get('delete-staff/{id}', 'StaffController@deleteStaff');
    Route::get('edit-staff/{id}', 'StaffController@editStaff');
    Route::get('create/{staff}/message', 'MessageController@createMessage')->name('email-staff');
    Route::post('edit-staff/{id}', [
        'uses' => 'StaffController@postEditStaff',
        'as' => 'edit-staff'
    ]);


    Route::get('create/{staff}/payroll', [
        'uses' => 'PayrollController@create',
        'as' => 'create-staff-payroll'
    ]);
    Route::post('save/payroll', [
        'uses' => 'PayrollController@store',
        'as' => 'store-staff-payroll'
    ]);
    Route::get('/all-staff-members/payroll', 'PayrollController@index')->name('all-staff-members-payroll');
    Route::get('send/{staff}/payroll/{payroll}', [
        'uses' => 'MessageController@sendStaffPayroll',
        'as' => 'send-staff-payroll'
    ]);


    Route::post('send/email', 'MessageController@sendMessage')->name('send-staff-message');




});



