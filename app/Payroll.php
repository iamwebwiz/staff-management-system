<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = ['id'];


    public function staff (){

        return $this->belongsTo(Staff::class, 'staff_id');
    }


}
