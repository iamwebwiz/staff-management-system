<?php

namespace Tests\Unit;

use App\Staff;
use App\User;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SendGeneralMessageToStaffTest extends TestCase
{
    use MailTracking;
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();

    }



    /** @test */
    public function an_authenticated_admin_can_send_message_to_staff()
    {
        $user = $this->actingAs($this->factoryWithoutObservers(User::class)->create());
        $staff = $this->factoryWithoutObservers(Staff::class)->create();
        $message = [
            'id' => $staff->id,
            'email' => 'aliuwahab@gmail.com',
            'subject' => 'Sample Subject',
            'content' => 'Sample Message Content'
        ];

        $response = $user->post("/send/message",$message);
        $response->assertStatus(302);

        $this->seeEmailSubject($message['subject']);
        $this->seeEmailTo($staff->email);
        $this->seeEmailContains($message['content']);


    }






}



