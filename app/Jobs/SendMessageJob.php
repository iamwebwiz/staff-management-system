<?php

namespace App\Jobs;

use App\Mail\EmailStaff;
use App\Message;
use App\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $staff;
    protected $content;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Staff $staff, Message $message)
    {
        $this->staff = $staff;
        $this->content = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->staff->user->email)->send(new EmailStaff($this->staff,$this->content));
    }
}
