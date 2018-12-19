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
Route::post('send/email', 'MessageController@sendMessage')->name('send-staff-message');


Route::post('edit-staff/{id}', [
	'uses' => 'StaffController@postEditStaff',
	'as' => 'edit-staff'
]);
