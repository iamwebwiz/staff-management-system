<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id','recipient_id','subject','content','is_delivered'];


    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'recipient_id');
    }


}
