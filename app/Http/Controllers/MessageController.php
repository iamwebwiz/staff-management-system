<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageRequest;
use App\Payroll;
use App\Repositories\MessageRepository;
use App\Staff;

class MessageController extends Controller
{
    protected $message_repository;

    public function __construct(MessageRepository $message_repository)
    {
        $this->message_repository = $message_repository;
    }

    public function createMessage(Staff $staff){
        $staff = Staff::with('user')->whereId($staff->id)->first();
         return view('message',compact('staff'));
    }

    public function sendMessage(SendMessageRequest $sendMessageRequest){
        return $this->message_repository->sendGeneralMessage($sendMessageRequest);
    }

    public function sendStaffPayroll(Staff $staff, Payroll $payroll){
        return $this->message_repository->sendStaffPayrollMessage($staff,$payroll);
    }
}
