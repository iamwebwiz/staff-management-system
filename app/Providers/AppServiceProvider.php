<?php

namespace App\Providers;

use App\Message;
use App\Observers\AdminObserver;
use App\Observers\MessageObserver;
use App\Observers\PayrollObserver;
use App\Observers\StaffObserver;
use App\Payroll;
use App\Staff;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(AdminObserver::class);
        Staff::observe(StaffObserver::class);
        Payroll::observe(PayrollObserver::class);
        Message::observe(MessageObserver::class);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
