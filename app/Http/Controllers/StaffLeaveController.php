<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminApproveRequest;
use App\Http\Requests\LeaveApplicationRequest;
use App\Repositories\LeaveManagementRepository;
use App\Staff;
use App\StaffLeave;
use Illuminate\Http\Request;

class StaffLeaveController extends Controller
{
    public $leave_management_repository;

    public function __construct(LeaveManagementRepository $leave_management_repository)
    {
        $this->leave_management_repository = $leave_management_repository;
    }

    public function create(){
        return view("apply-leave");
    }

    public function store(LeaveApplicationRequest $request){
        return $this->leave_management_repository->applyForLeave($request);
    }

    public function staffLeaves(Staff $staff){
        $leaves = $this->leave_management_repository->getAStaffLeave($staff);
        return view("user-leaves", compact('leaves'));
    }


    public function allPendingLeave(){
        $leaves = $this->leave_management_repository->getAllPendingLeave();
        return view('leaves', compact('leaves'))->with(['leave_type' => 'Pending Leaves']);
    }

    public function allApprovedLeave(){
        $leaves = $this->leave_management_repository->getAllApprovedLeave();
        return view('leaves', compact('leaves'))->with(['leave_type' => 'Approved Leaves']);
    }

    public function approveLeave(AdminApproveRequest $request){
        return $this->leave_management_repository->adminApproveLeave($request);
    }


}
