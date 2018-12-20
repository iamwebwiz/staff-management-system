<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 19/12/2018
 * Time: 4:36 PM
 */

namespace App\Observers;


use App\AuditTrail;
use App\Payroll;

class PayrollObserver
{



    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(Payroll $payroll)
    {
        $payroll = Payroll::with('staff')->where('id',$payroll->id )->first();
        $create_audit_trail = AuditTrail::create([
            'admin_id' =>auth()->id(),
            'resource_type_affected' => 'payroll',
            'affected_resource_id' => $payroll->id,
            'trail_activity_details' => 'Payslip was generated for '.$payroll->staff->name.' on'.$payroll->created_at.' by '.auth()->user()->name,
        ]);
    }


    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
//    public function updated(Payroll $user)
//    {
////        $time = Carbon::now();
////        $user->updated_at = $time;
////        $user->save();
//
//        $create_audit_trail = AuditTrail::create([
//            'admin_id' => $user->id,
//            'resource_type_affected' => 'admin',
//            'affected_resource_id' => $user->id,
//            'trail_activity_details' => 'Admin '.$user->name.' Just log into the app on ',
//        ]);
//
//    }



    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(Payroll $payroll)
    {
        //
    }



}