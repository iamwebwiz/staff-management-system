<?php

namespace Tests\Feature;

use App\Staff;
use App\StaffLeave;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LeaveManagementTest extends TestCase
{

    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

    /** @test */
    public function an_authenticated_staff_can_view_staff_leave_application_form()
    {
        $user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($user);
        $this->factoryWithoutObservers(Staff::class)->create();

        $response = $user->get(route('apply.leave'));

        $response->assertStatus(200);
        $response->assertViewIs("apply-leave");

    }


    /**
     * @test
     ** @expectedException \Illuminate\Auth\AuthenticationException
     */
    public function an_unauthenticated_staff_cannot_view_staff_leave_application_form()
    {
        $this->setExpectedException("\Illuminate\Auth\AuthenticationException");
        $this->get(route('apply.leave'));
    }



    /** @test */
    public function can_calculate_total_accrued_leave_days_for_a_staff()
    {

        //given
        $user = $this->factoryWithoutObservers(User::class)->create();
        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);
        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);


        //then
       $total_accrued_leave_days = $staff->getTotalAccruedLeaveDays();

       //assert
        $this->assertEquals(9, $total_accrued_leave_days);


    }


    /** @test */
    public function can_get_total_approved_leave_days_taken_by_a_staff()
    {

        //given
        $user = $this->factoryWithoutObservers(User::class)->create();
        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $user->id
        ]);

        $leave_start_date = Carbon::now()->addWeek(1);
        $leave_end_date = Carbon::now()->addWeek(2);

        $this->factoryWithoutObservers(StaffLeave::class, 3)->create([
            'staff_id' => $staff->id,
            'leave_start_date' => $leave_start_date,
            'leave_end_date' => $leave_end_date,
            'is_approved' => true
        ]);


        //then
        $total_leave_days_taken = $staff->getTotalLeaveDaysTaken();

        //assert... 15 is representing the number of week days in the above three leave created
        $this->assertEquals(15, $total_leave_days_taken);


    }




    /** @test */
    public function can_get_outstanding_leave_days_for_a_staff()
    {
        $user = $this->factoryWithoutObservers(User::class)->create();
        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);
        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);

        $leave_start_date = Carbon::now()->addWeek(1);
        $leave_end_date = Carbon::now()->addWeek(2);
        $this->factoryWithoutObservers(StaffLeave::class, 1)->create([
            'staff_id' => $staff->id,
            'leave_start_date' => $leave_start_date,
            'leave_end_date' => $leave_end_date,
            'is_approved' => true
        ]);


        //then
        $total_leave_days_taken = $staff->getTotalLeaveDaysTaken();
        $total_accrued_leave_days = $staff->getTotalAccruedLeaveDays();
        $outstanding_leave_days_for_staff = $staff->outStandingLeaveDays();


        //assert...9 is total accrued leave days. Which is 1.5 * total months work i.e (1.5 * 6)
        $this->assertEquals(9, $total_accrued_leave_days);
        // 5 is representing the number of week days in the above 1 week leave created
        $this->assertEquals(5, $total_leave_days_taken);
        $this->assertEquals(4, $outstanding_leave_days_for_staff);



    }



    /** @test */
    public function an_authenticated_staff_with_outstanding_leave_days_can_apply_for_leave()
    {
        $staff_user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($staff_user);

        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);

        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);


        $leave_application_details = [
            'staff_id' => $staff->id,
            'reason_for_leave' => "Just want leave",
            'leave_start_date' => Carbon::now()->addDays(4),
            'leave_end_date' => Carbon::now()->addWeek(),

        ];

        $response = $user->post('/leave', $leave_application_details);
        $this->assertDatabaseHas('staff_leaves', $leave_application_details);
        $response->assertStatus(302);
        $response->assertRedirect(route('my-leave',$staff));

//        $response->assertViewIs('user-leaves');


    }




    /** @test */
    public function an_authenticated_staff_can_view_all_leave_applied()
    {
        $staff_user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($staff_user);

        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);

        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);

        $this->factoryWithoutObservers(StaffLeave::class, 5)->create();
        $this->factoryWithoutObservers(StaffLeave::class)->create([
            'reason_for_leave' => 'Just for leave'
        ]);

        $response = $user->get(route('my-leave',$staff));
        $response->assertStatus(200);
        $response->assertViewIs('user-leaves');
        $response->assertSeeText('Just for leave');

    }


    /** @test */
    public function the_reason_for_leave_is_required_when_applying_for_leave()
    {
        $staff_user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($staff_user);

        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);

        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);


        $leave_application_details = [
            'staff_id' => $staff->id,
            'leave_start_date' => Carbon::now()->addDays(4),
            'leave_end_date' => Carbon::now()->addWeek(),

        ];

        $response = $user->post('/leave', $leave_application_details);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors('reason_for_leave');
        $response->assertStatus(302);
        $response->assertRedirect(route('apply.leave'));

    }


    /** @test */
    public function the_leave_start_date_is_required_when_applying_for_leave()
    {
        $staff_user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($staff_user);

        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);

        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);


        $leave_application_details = [
            'staff_id' => $staff->id,
            'reason_for_leave' => 'Just a comment',
            'leave_end_date' => Carbon::now()->addWeek(),

        ];

        $response = $user->post('/leave', $leave_application_details);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors('leave_start_date');
        $response->assertStatus(302);
        $response->assertRedirect(route('apply.leave'));

    }


    /** @test */
    public function the_leave_end_date_is_required_when_applying_for_leave()
    {
        $staff_user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($staff_user);

        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);

        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);


        $leave_application_details = [
            'staff_id' => $staff->id,
            'reason_for_leave' => 'Just a comment',
            'leave_start_date' => Carbon::now()->addWeek(2),

        ];

        $response = $user->post('/leave', $leave_application_details);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors('leave_end_date');
        $response->assertStatus(302);
        $response->assertRedirect(route('apply.leave'));

    }






    /** @test */
    public function the_leave_end_date_should_be_greater_than_the_leave_start_date_in_days_when_applying_for_leave()
    {
        $staff_user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($staff_user);

        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);

        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);


        $leave_application_details = [
            'staff_id' => $staff->id,
            'reason_for_leave' => 'Just a comment',
            'leave_start_date' => Carbon::now()->addWeek(2),
            'leave_end_date' => Carbon::now()->addWeek(2),

        ];

        $response = $user->post('/leave', $leave_application_details);

        $response->assertSessionHasErrors();
        $response->assertSessionHasErrors('error');
        $response->assertStatus(302);
        $response->assertRedirect(route('apply.leave'));

    }


    /** @test */
    public function an_authenticated_admin_can_view_all_leave_application_pending_approval()
    {
        //given
        $staff_user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($staff_user);

        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);

        $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);

        $this->factoryWithoutObservers(StaffLeave::class, 5)->create();
        $this->factoryWithoutObservers(StaffLeave::class)->create([
            'reason_for_leave' => 'Just for leave'
        ]);

        //then
        $response = $user->get(route('pending-leave'));

        //assert
        $response->assertStatus(200);
        $response->assertViewIs('leave');
        $response->assertSeeText('Just for leave');

    }


    /** @test */
    public function an_authenticated_admin_can_view_all_approved_leave_application()
    {

        //given
        $staff_user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($staff_user);

        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);

        $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);

        $this->factoryWithoutObservers(StaffLeave::class, 5)->create();
        $this->factoryWithoutObservers(StaffLeave::class)->create([
            'reason_for_leave' => 'Just for leave'
        ]);

        //then
        $response = $user->get(route('approved-leave'));

        //assert
        $response->assertStatus(200);
        $response->assertViewIs('leave');
        $response->assertSeeText('Just for leave');


    }


    /** @test */
    public function an_authenticated_admin_can_approve_a_pending_leave_application()
    {

        //given
        $staff_user = $this->factoryWithoutObservers(User::class)->create(['is_admin' => true]);
        $user = $this->actingAs($staff_user);
        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);
        $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);

        $leave = $this->factoryWithoutObservers(StaffLeave::class)->create([
            'is_approved' => false
        ]);

        //then
        $response = $user->post('/approve/leave',['leave_id' => $leave->id]);
        $leave = StaffLeave::find($leave->id);

        //assert
        $response->assertStatus(302);
        $this->assertTrue($leave->is_approved);
        $response->assertRedirect(route('approved-leave'));
        $response->assertViewIs('leave');
        $response->assertSeeText('Just for leave');


    }



    /** @test */
    public function a_non_admin_cannot_make_a_request_to_approve_a_leave()
    {
        //given
        $staff_user = $this->factoryWithoutObservers(User::class)->create(['is_admin' => false]);
        $user = $this->actingAs($staff_user);
        $start_work_date = Carbon::now()->subMonths(6);
        $created_at_date = Carbon::now()->subMonths(7);
        $this->factoryWithoutObservers(Staff::class)->create([
            'user_id' => $staff_user->id,
            'start_work_date' => $start_work_date,
            'created_at' => $created_at_date
        ]);

        $leave = $this->factoryWithoutObservers(StaffLeave::class)->create([
            'is_approved' => false
        ]);

        //then
        $response = $user->post('/approve/leave',['leave_id' => $leave->id]);
        $leave = StaffLeave::find($leave->id);

        //assert
        $response->assertStatus(302);
        $this->assertFalse($leave->is_approved);
        $response->assertRedirect(route('home'));

    }
























}
