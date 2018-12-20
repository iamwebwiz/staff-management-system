<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 20/12/2018
 * Time: 6:48 AM
 */

namespace App\Repositories;


use App\Http\Controllers\PayrollController;
use App\Payroll;
use App\Staff;
use Illuminate\Http\Request;

class PayrollRepository
{
    public function __construct()
    {

    }


    public function createPayroll(Request $request, PayrollController $payrollController){
        $staff = Staff::where('id', $request->get('staff_id'))->first();
        $create_payroll_details = $this->buildPayrollProperties($request);
        $create_payroll = Payroll::create($create_payroll_details);

        if ($create_payroll) {
            return $payrollController->payrollCreatedSuccessfully($create_payroll, $staff);
        }
        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return array
     */
    public function buildPayrollProperties(Request $request)
    {
        $create_payroll_details = $request->except('_token');
        $tax_percentage = $request->get('tax_percentage');
        $gross_salary = $request->get('gross_salary');
        $create_payroll_details = array_add($create_payroll_details, 'net_salary', (1 - ($tax_percentage / 100)) * $gross_salary);
        return $create_payroll_details;
    }




}