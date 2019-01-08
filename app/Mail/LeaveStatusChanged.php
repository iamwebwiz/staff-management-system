<?php

namespace App\Mail;

use App\Staff;
use App\StaffLeave;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LeaveStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $leave;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Staff $staff, StaffLeave $leave)
    {
        $this->staff = $staff;
        $this->leave = $leave;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email-leave-status')
            ->to($this->staff->user->email)
            ->subject('Status of your leave application');
    }
}
