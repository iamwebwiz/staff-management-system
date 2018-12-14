<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageRequest;
use App\Jobs\SendMessageJob;
use App\Mail\EmailStaff;
use App\Message;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{


    public function createMessage(Staff $staff){
         return view('message',compact('staff'));
    }


    public function sendMessage(SendMessageRequest $sendMessageRequest){

        $staff = Staff::findOrFail($sendMessageRequest->get('id'));
        $create_message = Message::create([
            'sender_id' => auth()->id(),
            'subject' => $sendMessageRequest->get('subject'),
            'content' => $sendMessageRequest->get('content')
        ]);


        SendMessageJob::dispatch($staff,$create_message);

        return redirect()->route('all-staff-members');
        
    }





}
