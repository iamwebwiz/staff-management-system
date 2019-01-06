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

    public function outStandingLeaveDays(){
        return ($this->getTotalAccruedLeaveDays() - $this->getTotalLeaveDaysTaken());
    }

    public function getTotalAccruedLeaveDays(){
        return (1.5 * ($this->start_work_date->diffInMonths(Carbon::now())));
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
