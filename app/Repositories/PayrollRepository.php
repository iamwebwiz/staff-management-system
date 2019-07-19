<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 20/12/2018
 * Time: 6:48 AM
 */

namespace App\Repositories;


use App\Http\Controllers\PayslipController;
use App\Payroll;
use App\Staff;
use Illuminate\Http\Request;

class PayrollRepository
{

    public $message_repository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->message_repository = $messageRepository;
    }

    public function createPayslip(Request $request, PayslipController $payrollController){
        $staff = Staff::with('user')->where('id', $request->get('staff_id'))->first();
        $create_payroll_details = $this->buildPayslipProperties($request);
        $create_payroll = Payroll::create($create_payroll_details);

        if ($create_payroll) {
            $this->message_repository->sendStaffPayrollMessage($staff, $create_payroll);
            return redirect()->route("all-staff-members-payroll");
        }
        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return array
     */
    public function buildPayslipProperties(Request $request)
    {
        $create_payroll_details = $request->except('_token');
        $tax_percentage = $request->get('tax_percentage');
        $gross_salary = $request->get('gross_salary');
        $create_payroll_details = array_add($create_payroll_details, 'net_salary', (1 - ($tax_percentage / 100)) * $gross_salary);
        return $create_payroll_details;
    }




}