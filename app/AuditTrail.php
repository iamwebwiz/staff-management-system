<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $fillable = ['admin_id','trail_activity_details','resource_type_affected','affected_resource_id'];
}
