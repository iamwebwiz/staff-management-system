<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
        'start_work_date',
    ];

    public function user(){

        return $this->belongsTo(User::class, 'user_id');
    }

    public function getOutStandingLeaveDays($upto = null){
        if (is_null($upto)) {
            $upto = Carbon::now();
        }
        return ($this->getTotalAccruedLeaveDays($upto) - $this->getTotalLeaveDaysTaken());
    }

    public function getTotalAccruedLeaveDays($upto = null){

        if (is_null($upto)) {
            $upto = Carbon::now();
        }
        return (env("ACCRUED_LEAVE_DAYS_IN_A_MONTH") * ($this->start_work_date->diffInMonths($upto)));
    }


    public function getTotalLeaveDaysTaken(){

         return $this->getAllApproveLeaveTaken()->reduce(function ($carry, $item){
            return $carry += (getNumberOfWeekDaysBetweenTwoDates($item->leave_start_date, $item->leave_end_date));
        }, 0);

    }


    public function getAllApproveLeaveTaken(){
        return $this->leaves()->where('is_approved', true)->get();
    }

    public function leaves(){

        return $this->hasMany(StaffLeave::class, 'staff_id');
    }



}
