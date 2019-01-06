<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffLeaveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff_leaves')->insert([
            'staff_id' => \App\Staff::find(rand(1,2))->id,
            'reason_for_leave' => 'I just want to go for leave',
            'leave_start_date' => \Carbon\Carbon::now()->addWeek(),
            'leave_end_date' => \Carbon\Carbon::now()->addWeeks(2),
            'is_approved' => true,
        ]);

        DB::table('staff_leaves')->insert([
            'staff_id' => \App\Staff::find(rand(1,2))->id,
            'reason_for_leave' => 'I just want to go for leave',
            'leave_start_date' => \Carbon\Carbon::now()->addWeeks(2),
            'leave_end_date' => \Carbon\Carbon::now()->addWeeks(2),
            'is_approved' => true,
        ]);

        DB::table('staff_leaves')->insert([
            'staff_id' => \App\Staff::find(rand(1,2))->id,
            'reason_for_leave' => 'I just want to go for leave',
            'leave_start_date' => \Carbon\Carbon::now()->addWeeks(3),
            'leave_end_date' => \Carbon\Carbon::now()->addWeeks(4),
            'is_approved' => true,
        ]);

        DB::table('staff_leaves')->insert([
            'staff_id' => \App\Staff::find(rand(1,2))->id,
            'reason_for_leave' => 'I just want to go for leave',
            'leave_start_date' => \Carbon\Carbon::now()->addWeeks(4),
            'leave_end_date' => \Carbon\Carbon::now()->addWeeks(5),
            'is_approved' => false,
        ]);

        DB::table('staff_leaves')->insert([
            'staff_id' => \App\Staff::find(rand(1,2))->id,
            'reason_for_leave' => 'I just want to go for leave',
            'leave_start_date' => \Carbon\Carbon::now()->addWeeks(5),
            'leave_end_date' => \Carbon\Carbon::now()->addWeeks(6),
            'is_approved' => true,
        ]);

    }
}
