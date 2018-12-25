<?php

namespace App\Jobs;

use App\Mail\SendPayslipEmail;
use App\Message;
use App\Payroll;
use App\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendPaySlipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $staff;
    protected $content;
    protected $payroll;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->staff)->send(new SendPayslipEmail($this->staff,$this->content, $this->payroll));
    }
}
