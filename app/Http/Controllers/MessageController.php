<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageRequest;
use App\Jobs\SendMessageJob;
use App\Jobs\SendPaySlipJob;
use App\Mail\EmailStaff;
use App\Mail\SendPayslipEmail;
use App\Message;
use App\Payroll;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{


    public function createMessage(Staff $staff){
         return view('message',compact('staff'));
    }


    public function sendMessage(SendMessageRequest $sendMessageRequest){

        $staff = Staff::findOrFail($sendMessageRequest->get('id'));
        $create_message = Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $staff->id,
            'subject' => $sendMessageRequest->get('subject'),
            'content' => $sendMessageRequest->get('content')
        ]);
        SendMessageJob::dispatch($staff,$create_message);
        return redirect()->route('all-staff-members');
    }



    public function sendStaffPayroll(Staff $staff, Payroll $payroll){

//        return $payroll;

        $payroll = Payroll::with('staff')->whereId($payroll->id)->first();
        $create_message = Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $payroll->staff->id,
            'subject' => "Your Invoice for ".$payroll->month." ".$payroll->year,
            'content' => "Invoice sent to ".$staff->name." for ".$payroll->month." ".$payroll->year,
        ]);

        SendPaySlipJob::dispatch($staff,$create_message,$payroll);
        return redirect()->route('all-staff-members-payroll');

    }





}
