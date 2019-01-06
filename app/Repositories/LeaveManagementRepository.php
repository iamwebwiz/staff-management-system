<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 04/01/2019
 * Time: 7:42 AM
 */

namespace App\Repositories;


use App\Jobs\SendLeaveStatusEmail;
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

        $leave_details = $this->buildLeaveProperties($request);

        $create_staff_leave = StaffLeave::create($leave_details);
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
        $approve_leave = StaffLeave::where('id', $request->get('leave_id'))->update(['is_approved' => true]);

        if ($approve_leave) {
            $leave = StaffLeave::find($request->get('leave_id'));
            $staff = Staff::with('user')->find($leave->staff_id);
            SendLeaveStatusEmail::dispatch($staff,$leave);
        }

        return redirect()->route('approved-leave');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function buildLeaveProperties(Request $request)
    {
        $staff = Staff::find($request->get('user_id'));
        $leave_details = $request->except('token', 'user_id');
        $leave_details = array_add($leave_details, 'staff_id', $staff->id);
        return $leave_details;
    }


}