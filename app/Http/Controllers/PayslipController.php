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

class PayslipController extends Controller
{
    public $payslip;
    public $message_repository;

    public function __construct(PayrollRepository $payslip, MessageRepository $messageRepository)
    {
        $this->payslip = $payslip;
        $this->message_repository = $messageRepository;
    }

    public function index(){
        $payrolls = Payroll::with("staff.user")->get();
        return view("all-staff-payrolls", compact('payrolls'));
    }

    public function create(Staff $staff){
        return view('create-payslip', compact('staff'));
    }

    public function store(PayrollRequest $request)
    {
        return $this->payslip->createPayslip($request, $this);
    }










}
