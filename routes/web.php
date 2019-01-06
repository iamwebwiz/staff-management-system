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

use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/', function () {
    return redirect()->route('login');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users', 'AdminController@index')->name('all-admins');

    Route::middleware(['user.type'])->group(function () {
        Route::get('/staff', 'StaffController@index')->name('all-staff-members');
        Route::get('/staff/create', 'StaffController@create')->name('new-staff');
        Route::post('/staff', ['uses' => 'StaffController@store', 'as' => 'add-new-staff']);
        Route::delete('/staff/{staff}',['uses' => 'StaffController@delete', 'as' => 'delete-staff']);

        Route::get('create/{staff}/message', 'MessageController@createMessage')->name('email-staff');


        Route::get('/payslips/{staff}/create', ['uses' => 'PayslipController@create', 'as' => 'create-staff-payroll']);
        Route::post('/payslips', ['uses' => 'PayslipController@store', 'as' => 'store-staff-payroll']);
        Route::get('/payslips', 'PayslipController@index')->name('all-staff-members-payroll');

        Route::post('/send/message', 'MessageController@sendMessage')->name('send-staff-message');
        Route::get('send/{staff}/payroll/{payroll}', ['uses' => 'MessageController@sendStaffPayroll', 'as' => 'send-staff-payroll']);
        Route::get('/pending/leave', 'StaffLeaveController@allPendingLeave')->name('pending-leave');
        Route::get('/approved/leave', 'StaffLeaveController@allApprovedLeave')->name('approved-leave');
        Route::post('/approve/leave', 'StaffLeaveController@approveLeave')->name('admin-approve-leave');

    });


    Route::get('/staff/{staff}',['uses' => 'StaffController@show', 'as' => 'show-staff']);
    Route::get('/staff/{staff}/edit',['uses' => 'StaffController@edit', 'as' => 'edit-staff']);
    Route::put('/staff/{staff}', ['uses' => 'StaffController@update', 'as' => 'update-staff']);

    Route::get('/leave/create', 'StaffLeaveController@create')->name('apply.leave');
    Route::post('/leave', 'StaffLeaveController@store')->name('store.leave');
    Route::get('/staff/{staff}/leave', 'StaffLeaveController@staffLeaves')->name('my-leave');





});



