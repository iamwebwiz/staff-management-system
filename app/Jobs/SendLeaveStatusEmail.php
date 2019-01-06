<?php

namespace App\Jobs;

use App\Staff;
use App\StaffLeave;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendLeaveStatusEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $staff;
    public $leave;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Staff $staff, StaffLeave $leave)
    {
        $this->staff = $staff;
        $this->leave = $leave;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
