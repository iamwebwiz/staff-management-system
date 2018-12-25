<?php

namespace Tests\Unit;

use App\Payroll;
use App\Staff;
use App\User;
use Spinen\MailAssertions\MailTracking;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SendPayslipTest extends TestCase
{
    use MailTracking;
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

    /** @test */
    public function an_authenticated_admin_can_send_payslip_as_message_to_staff()
    {

        $user = $this->actingAs($this->factoryWithoutObservers(User::class)->create());
        $staff = $this->factoryWithoutObservers(Staff::class)->create();
        $payslip = $this->factoryWithoutObservers(Payroll::class)->create();

        $response = $user->get('send/'.$staff->id.'/payroll/'.$payslip->id);
        $response->assertStatus(302);

        $this->seeEmailTo($staff->email);
        $this->seeEmailSubject("Your Invoice for " . $payslip->month . " " . $payslip->year);

    }
}
