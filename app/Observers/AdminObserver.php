<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 14/12/2018
 * Time: 7:10 AM
 */

namespace App\Observers;


use App\AuditTrail;
use App\User;
use Carbon\Carbon;

class AdminObserver
{


    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        $create_audit_trail = AuditTrail::create([
            'admin_id' => $user->id,
            'resource_type_affected' => 'admin',
            'affected_resource_id' => $user->id,
            'trail_activity_details' => 'Admin '.$user->name.' was added as an administrator on '.$user->created_at.' by '.auth()->user()->name,
        ]);
    }


    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function updated(User $user)
    {
//        $time = Carbon::now();
//        $user->updated_at = $time;
//        $user->save();

        $create_audit_trail = AuditTrail::create([
            'admin_id' => $user->id,
            'resource_type_affected' => 'admin',
            'affected_resource_id' => $user->id,
            'trail_activity_details' => 'Admin '.$user->name.' Just log into the app on ',
        ]);

    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        //
    }






}