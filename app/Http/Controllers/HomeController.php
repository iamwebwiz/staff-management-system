<?php

namespace App\Http\Controllers;

use App\AuditTrail;
use Illuminate\Http\Request;
use App\Staff;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recent_activities = AuditTrail::latest()->get();
        return view('home', compact('recent_activities'));
    }

    public function newStaff(){
    	return view('new-staff');
    }

    public function allStaffMembers(){
    	$staff = Staff::orderBy('created_at', 'asc')->get();
    	return view('all-staff-members', compact('staff'));
    }

    public function editStaff($staff_id){
    	$staff =  Staff::find($staff_id);
    	return view('edit-staff-member', compact('staff'));
    }
}
