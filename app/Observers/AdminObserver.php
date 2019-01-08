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
        AuditTrail::create([
            'admin_id' => $user->id,
            'resource_type_affected' => 'user',
            'affected_resource_id' => $user->id,
            'trail_activity_details' => 'Admin '.$user->name.' was added a user on '.$user->created_at.' by '.auth()->user()->name,
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
         AuditTrail::create([
            'admin_id' => $user->id,
            'resource_type_affected' => 'user',
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