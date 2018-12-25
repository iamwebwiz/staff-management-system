<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 14/12/2018
 * Time: 7:10 AM
 */

namespace App\Observers;


use App\AuditTrail;
use App\Message;
use Illuminate\Support\Facades\Auth;

class MessageObserver
{

    /**
     * Listen to the User created event.
     *
     * @param  Staff  $staff
     * @return void
     */
    public function created(Message $message)
    {

        $message = Message::with('staff')->where('id', $message->id)->first();

        $create_audit_trail = AuditTrail::create([
            'admin_id' => auth()->id(),
            'recipient_id' => $message->staff->id,
            'resource_type_affected' => 'messaging',
            'affected_resource_id' => $message->id,
            'trail_activity_details' => 'Admin '.Auth::user()->name.' sent message to staff '.$message->staff->name.' on '.$message->created_at,
        ]);

    }









}