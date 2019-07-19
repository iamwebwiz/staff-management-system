<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 19/12/2018
 * Time: 7:54 AM
 */

namespace App\Repositories;


use App\Jobs\SendMessageJob;
use App\Jobs\SendPaySlipJob;
use App\Mail\EmailStaff;
use App\Message;
use App\Payroll;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageRepository
{


    public function sendGeneralMessage(Request $sendMessageRequest)
    {
        $staff = Staff::with('user')->find($sendMessageRequest->get('id'));
        $create_message = $this->createGeneralMessage($sendMessageRequest, $staff);
        if ($create_message) {
            SendMessageJob::dispatch($staff,$create_message);
            return redirect()->route('all-staff-members');
        }
        return redirect()->back();
    }

    /**
     * @param Request $sendMessageRequest
     * @param $staff
     * @return mixed
     */
    private function createGeneralMessage(Request $sendMessageRequest, $staff)
    {
        $create_message = Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $staff->id,
            'subject' => $sendMessageRequest->get('subject'),
            'content' => $sendMessageRequest->get('content')
        ]);
        return $create_message;
    }



    public function sendStaffPayrollMessage(Staff $staff, Payroll $payroll){

        $staff = Staff::with('user')->whereId($staff->id)->first();
        $payroll = Payroll::with('staff.user')->whereId($payroll->id)->first();
        $create_message = $this->createStaffPayrollMessage($staff, $payroll);

        if ($create_message) {
            SendPaySlipJob::dispatch($staff,$create_message,$payroll);
            return redirect()->route('all-staff-members-payroll');
        }
        return redirect()->back();
    }

    /**
     * @param Staff $staff
     * @param Payroll $payroll
     * @return Message|\Illuminate\Database\Eloquent\Model
     */
    private function createStaffPayrollMessage(Staff $staff, Payroll $payroll)
    {
        $create_message = Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $payroll->staff->id,
            'subject' => "Your Invoice for " . $payroll->month . " " . $payroll->year,
            'content' => "Invoice sent to " . $staff->name . " for " . $payroll->month . " " . $payroll->year,
        ]);
        return $create_message;
    }





}