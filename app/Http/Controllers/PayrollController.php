<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayrollRequest;
use App\Jobs\SendMessageJob;
use App\Jobs\SendPaySlipJob;
use App\Message;
use App\Payroll;
use App\Repositories\MessageRepository;
use App\Repositories\PayrollRepository;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public $pay_roll;
    public $messsage_repository;

    public function __construct(PayrollRepository $pay_roll, MessageRepository $messageRepository)
    {
        $this->pay_roll = $pay_roll;
        $this->messsage_repository = $messageRepository;
    }

    public function index(){
        $payrolls = Payroll::with("staff")->get();
        return view("all-staff-payrolls", compact('payrolls'));
    }


    public function create(Staff $staff){
        return view('create-payroll', compact('staff'));
    }


    public function store(PayrollRequest $request)
    {
        return $this->pay_roll->createPayroll($request, $this);
    }


    public function payrollCreatedSuccessfully(Payroll $created_payroll, Staff $staff){
        $this->messsage_repository->sendStaffPayrollMessage($staff,$created_payroll);
        return redirect()->route("all-staff-members-payroll");
    }








}
