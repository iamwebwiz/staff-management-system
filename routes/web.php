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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/new-staff', 'HomeController@newStaff')->name('new-staff');
Route::get('/all-staff-members', 'HomeController@allStaffMembers')->name('all-staff-members');

Route::post('add-new-staff', [
	'uses' => 'AdminController@addNewStaff',
	'as' => 'add-new-staff',
	'middleware' => 'auth'
]);

Route::get('delete-staff/{id}', 'AdminController@deleteStaff');

Route::get('edit-staff/{id}', 'HomeController@editStaff');


Route::get('create/{staff}/message', 'MessageController@createMessage')->name('email-staff');
Route::post('send/email', 'MessageController@sendMessage')->name('send-staff-message');

Route::post('edit-staff/{id}', [
	'uses' => 'AdminController@postEditStaff',
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
    'uses' => 'PayrollController@sendStaffPayroll',
    'as' => 'send-staff-payroll'
]);

