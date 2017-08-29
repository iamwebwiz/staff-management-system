<?php

namespace App\Http\Controllers;

use App\User;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
    public function addNewStaff(Request $request){
    	$this->validate($request, [
    		'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:staff',
            'image' => 'required|mimes:jpg,tiff,png,svg,gif,bmp,jpeg|max:10240',
            'address' => 'max:255',
            'level' => 'required'
        ]);
        
    	if ($request->hasFile('image')){
    		$image = $request->file('image');
    		$filename = $request['name'] . time() . '.' . $request->image->getClientOriginalExtension();
    		$image = $request->image->move(storage_path('app/public/staff'), $filename);
    	}
    	else {
    		return "No file selected!";
    	}

    	// Create new staff
    	$staff = new Staff;
    	$staff->name = $request['name'];
    	$staff->email = $request['email'];
    	$staff->age = $request['age'];
    	$staff->phone = $request['phone'];
    	$staff->image = $filename;
    	$staff->address = $request['address'];
    	$staff->city = $request['city'];
    	$staff->state = $request['state'];
    	$staff->country = $request['country'];
    	$staff->level = $request['level'];

    	if ($staff->save()){
    		// successful
    		return redirect()->route('all-staff-members')->with('message', 'New Staff Added to the company&rsquo;s database');
    	}
    	return redirect()->back();
    }

    public function deleteStaff($staff_id){
    	$staff = Staff::where('id', $staff_id)->first();
    	$staff->delete();
    	return redirect()->back()->with('message', 'Successfully removed staff member from database');
    }
}
