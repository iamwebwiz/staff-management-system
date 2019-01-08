<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffLeave extends Model
{
    protected $table = "staff_leaves";
    protected $guarded = ['id'];
    protected $dates = [
        'leave_start_date',
        'leave_end_date',
    ];

    protected $casts = ['is_approved' => 'boolean'];

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }







}
