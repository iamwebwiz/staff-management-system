<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessageJob;
use App\Message;
use App\Payroll;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{

    public function index(){
        $payrolls = Payroll::with("staff")->get();
        return view("all-staff-payrolls", compact('payrolls'));
    }


    public function create(Staff $staff){
        return view('create-payroll', compact('staff'));
    }


    public function store(Request $request){

        $this->validate($request, [
            'staff_id' => 'required',
            'gross_salary' => 'required|numeric',
            'tax_percentage' => 'required|numeric',
            'month' => 'required',
            'year' => 'required'
        ]);

       $create_payroll_details = $request->except('_token');
       $tax_percentage = $request->get('tax_percentage');
       $gross_salary = $request->get('gross_salary');
       $create_payroll_details  = array_add($create_payroll_details, 'net_salary',(1-($tax_percentage/100)) * $gross_salary);

       $create_payroll = Payroll::create($create_payroll_details);

        if ($create_payroll) {

            return redirect()->route("all-staff-members-payroll");
        }


        return redirect()->back();

    }








}
