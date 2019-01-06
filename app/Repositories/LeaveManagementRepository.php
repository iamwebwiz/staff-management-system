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
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveManagementRepository
{
    public $message_repository;
    public function __construct(MessageRepository $messageRepository)
    {
        $this->message_repository = $messageRepository;
    }

    public function applyForLeave(Request $request){

        $staff = Staff::find($request->get('user_id'));
        $outstanding_leave_days = $staff->getOutStandingLeaveDays();
        $number_of_leave_days_applying_for = $this->getNumberOfLeaveDaysApplyingFor($request);
        if ($number_of_leave_days_applying_for > $outstanding_leave_days) {
            return redirect()->back()->with([
                'err' => 'error',
                'message' => "number of leave days you're applying for (".$number_of_leave_days_applying_for.") is greater than your outstanding leave days (".$outstanding_leave_days.")"
            ]);
        }

        $leave_details = $this->buildLeaveRequestDetails($request, $staff);
        $create_staff_leave = StaffLeave::create($leave_details);
        return redirect()->route("my-leave", $create_staff_leave->staff_id);
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
     * @return int
     */
    private function getNumberOfLeaveDaysApplyingFor(Request $request)
    {
        $leave_start_date = Carbon::parse($request->get('leave_start_date'));
        $leave_end_date = Carbon::parse($request->get('leave_end_date'));
        $number_of_leave_days_applying_for = getNumberOfWeekDaysBetweenTwoDates($leave_start_date, $leave_end_date);
        return $number_of_leave_days_applying_for;
    }

    /**
     * @param Request $request
     * @param $staff
     * @return array
     */
    private function buildLeaveRequestDetails(Request $request, $staff)
    {
        $leave_details = $request->except('token', 'user_id');
        $leave_details = array_add($leave_details, 'staff_id', $staff->id);
        return $leave_details;
    }


}