<?php

namespace App\Mail;

use App\Message;
use App\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailStaff extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Staff $staff, Message $message)
    {
        $this->staff = $staff;
        $this->content = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.message')
            ->subject($this->content->subject);
    }
}
