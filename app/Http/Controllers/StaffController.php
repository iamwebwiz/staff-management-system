<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\EditStaffRequest;
use App\Interfaces\RespondsToStaffCreated;
use App\Repositories\StaffRepository;
use App\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller implements RespondsToStaffCreated
{
    public $staff_repository;

    public function __construct(StaffRepository $staff_repository){
        $this->middleware('auth');
        $this->staff_repository = $staff_repository;
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


    public function addNewStaff(CreateStaffRequest $request){
        return $this->staff_repository->createStaff($request, $this);
    }


    public function deleteStaff($staff_id){
        return $this->staff_repository->deleteStaff($staff_id);
    }



    public function postEditStaff(EditStaffRequest $request, $staff_id){
        return $this->staff_repository->updateStaffProfile($request,$staff_id, $this);
    }


    public function staffCreatedSuccessfully($message = 'New Staff Added to the company&rsquo;s database')
    {
        return redirect()->route('all-staff-members')->with('message', $message);
    }

    public function staffCreatedUnSuccessfully($message = "Unable to create staff")
    {
        return redirect()->back()->with('err', $message);
    }



}
