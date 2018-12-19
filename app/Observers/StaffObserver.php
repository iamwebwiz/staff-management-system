<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 14/12/2018
 * Time: 7:10 AM
 */

namespace App\Observers;


use App\AuditTrail;
use App\Staff;
use Illuminate\Support\Facades\Auth;

class StaffObserver
{


    /**
     * Listen to the User created event.
     *
     * @param  Staff  $staff
     * @return void
     */
    public function created(Staff $staff)
    {

        $create_audit_trail = AuditTrail::create([
            'admin_id' => auth()->id(),
            'resource_type_affected' => 'staff',
            'affected_resource_id' => $staff->id,
            'trail_activity_details' => 'Admin '.Auth::user()->name.' Just created staff with name '.$staff->name.' on '.$staff->created_at,
        ]);

    }


    /**
     * Listen to the User deleting event.
     *
     * @param  Staff  $staff
     * @return void
     */
    public function updated(Staff $staff)
    {
        $create_audit_trail = AuditTrail::create([
            'admin_id' => auth()->id(),
            'resource_type_affected' => 'staff',
            'affected_resource_id' => $staff->id,
            'trail_activity_details' => 'Admin '.Auth::user()->name.' Just edited staff with name '.$staff->name.' on '.$staff->created_at,
        ]);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  Staff  $staff
     * @return void
     */
    public function deleting(Staff $staff)
    {
        $create_audit_trail = AuditTrail::create([
            'admin_id' => auth()->id(),
            'resource_type_affected' => 'staff',
            'affected_resource_id' => $staff->id,
            'trail_activity_details' => 'Admin '.Auth::user()->name.' Just deleted staff with name '.$staff->name.' on '.$staff->created_at,
        ]);

    }





}