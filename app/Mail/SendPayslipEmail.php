<?php

namespace App\Mail;

use App\Message;
use App\Payroll;
use App\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPayslipEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $content;
    public $payroll;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Staff $staff, Message $message, Payroll $payroll)
    {
        $this->staff = $staff;
        $this->content = $message;
        $this->payroll = $payroll;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email-pay-slip')
            ->to($this->staff->user->email)
            ->subject($this->content->subject);
    }
}
