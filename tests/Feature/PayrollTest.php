<?php

namespace Tests\Feature;

use App\Payroll;
use App\Staff;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PayrollTest extends TestCase
{

    use DatabaseMigrations;


    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }



    /** @test */
    public function an_authenticated_admin_can_view_form_for_creating_staff_payslip()
    {
        $user = $this->actingAs($this->factoryWithoutObservers(User::class)->create(['is_admin' => true]));
        $this->factoryWithoutObservers(Staff::class)->create();

        $staff = Staff::first();

        $response = $user->get('/payslips/'.$staff->id.'/create');
        $response->assertStatus(200);
        $response->assertViewIs("create-payslip");

    }


    /** @test */
    public function an_authenticated_admin_can_add_staff_payslip()
    {
        $user = $this->actingAs($this->factoryWithoutObservers(User::class)->create(['is_admin' => true]));
        $staff = $this->factoryWithoutObservers(Staff::class)->create(['user_id' => auth()->id()]);

        $pay_slip_details = [
            'staff_id' => $staff->id,
            'gross_salary' => 100000,
            'tax_percentage' => 10,
            'net_salary' => 10000,
            'month' => 'January',
            'year' => 2019
        ];

       $response = $user->post('/payslips', $pay_slip_details);
       $response->assertStatus(302);
        $payslip = Payroll::first();
        $this->assertEquals(100000,$payslip->gross_salary);
        $this->assertDatabaseHas('payrolls', $pay_slip_details);

    }



    /** @test */
    public function an_authenticated_admin_can_view_all_staff_payslips()
    {
        $user = $this->actingAs($this->factoryWithoutObservers(User::class)->create(['is_admin' => true]));
        $this->factoryWithoutObservers(Staff::class)->create();
        $this->factoryWithoutObservers(Payroll::class, 5)->create();
        $payslip = $this->factoryWithoutObservers(Payroll::class)->create([
            'gross_salary' => 14000
        ]);

        $response = $user->get('/payslips');
        $response->assertStatus(200);
        $response->assertViewHas('payrolls');
        $response->assertSeeText("14000");


    }





}
