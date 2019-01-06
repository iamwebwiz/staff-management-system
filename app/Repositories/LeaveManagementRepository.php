<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 04/01/2019
 * Time: 7:42 AM
 */

namespace App\Repositories;


use App\Staff;
use App\StaffLeave;
use Illuminate\Http\Request;

class LeaveManagementRepository
{
    public $message_repository;
    public function __construct(MessageRepository $messageRepository)
    {
        $this->message_repository = $messageRepository;
    }

    public function applyForLeave(Request $request){
        $create_staff_leave = StaffLeave::create($request->all());
        if ($create_staff_leave) {
            return redirect()->route("my-leave", $create_staff_leave->staff_id);
        }
        return redirect()->back();
    }


    public function getAStaffLeave(Staff $staff)
    {
        return Staff::with('user','leaves')->where('id', $staff->id)->first();
    }


    public function getAllPendingLeave()
    {
        return StaffLeave::with('staff.user')->where('is_approved', false)->get();
    }

    public function getAllApprovedLeave()
    {
        return StaffLeave::with('staff.user')->where('is_approved', true)->get();
    }

    public function adminApproveLeave(Request $request)
    {
        StaffLeave::where('id', $request->get('leave_id'))->update(['is_approved' => true]);

        return redirect()->route('approved-leave');
    }









}