<?php

namespace App\Jobs;

use App\Mail\SendAdminLoginDetails;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendAdminLoginJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $admin;
    protected $password;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->admin = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->admin)->send(new SendAdminLoginDetails($this->admin,$this->password));
    }




}
