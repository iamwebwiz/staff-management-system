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

    public function __construct(StaffRepository $staff_repository)
    {
        $this->middleware('auth');
        $this->staff_repository = $staff_repository;
    }


    public function create()
    {
        return view('new-staff');
    }

    public function index()
    {
        $staff = Staff::orderBy('created_at', 'asc')->get();
        return view('all-staff-members', compact('staff'));
    }

    public function edit($staff_id)
    {
        $staff =  Staff::find($staff_id);
        return view('edit-staff-member', compact('staff'));
    }


    public function store(CreateStaffRequest $request)
    {
        return $this->staff_repository->createStaff($request, $this);
    }

    public function show(Staff $staff){
        return $this->staff_repository->getOneStaff($staff);
    }

    public function delete($staff_id)
    {
        return $this->staff_repository->deleteStaff($staff_id);
    }


    public function update(EditStaffRequest $request, $staff_id)
    {
        return $this->staff_repository->updateStaffProfile($request,$staff_id, $this);
    }


    public function successfulResponse($message = 'New Staff Added to the company&rsquo;s database')
    {
        return redirect()->route('all-staff-members')->with('message', $message);
    }

    public function unSuccessfulResponse($message = "Unable to create staff")
    {
        return redirect()->back()->with('err', $message);
    }



}
