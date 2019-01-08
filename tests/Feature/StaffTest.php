<?php

namespace Tests\Feature;

use App\Staff;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StaffTest extends TestCase
{

    use DatabaseMigrations;


    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

    /** @test */
    public function an_authenticated_admin_can_visit_create_staff_page()
    {
        $user = $this->factoryWithoutObservers(User::class)->create(['is_admin' => true]);
        $user = $this->actingAs($user);
        $response = $user->get('/staff/create');
        $response->assertStatus(200);
    }


    /** @test */
    public function an_authenticated_admin_can_create_a_staff()
    {
        Storage::fake('app/public/staff');
        $user = $this->factoryWithoutObservers(User::class)->create(['is_admin' => true]);
        $user = $this->actingAs($user);

        $staff_details = [
            'name' => 'Aliu',
            'email' => 'aliuwaha23b@gmail.com',
            'age' => 29,
            'phone' => '0207361611',
            'address' => 'Shalom Estate',
            'city' => 'Accra',
            'state' => 'Ghana',
            'country' => 'Ghana',
            'level' => 'Manager',
            'start_work_date' => Carbon::now(),
            'image' => $file = UploadedFile::fake()->image('avatar.jpg')
        ];

        $user->post("/staff",$staff_details);
        $staff = Staff::with('user')->first();
        $this->assertDatabaseHas('staff', ['age' => 29]);
        $this->assertEquals("Aliu", $staff->user->name);

    }


    /** @test */
    public function an_authenticated_admin_can_view_a_staff()
    {
        $date = Carbon::now();

        $user = $this->factoryWithoutObservers(User::class)->create([
            'name' => 'John Doe',
            'email' => 'aliuwahab@gmail.com',
            'is_admin' => true
        ]);
        $authenticatedUser = $this->actingAs($user);
        $create_staff = $this->factoryWithoutObservers(Staff::class)->create([
            'age' => 29,
            'user_id' => $user->id,
            'start_work_date' => $date
        ]);

        $staff = Staff::with('user')->find($create_staff->id);

        $response = $authenticatedUser->get(route("show-staff", $staff));
        $response->assertStatus(200);
        $response->assertSeeText($staff->user->name);
        $response->assertSeeText($staff->user->email);
        $response->assertSeeText($staff->phone);

    }




    /** @test */
    public function an_authenticated_admin_can_edit_a_staff()
    {
        $user = $this->factoryWithoutObservers(User::class)->create(['is_admin' => true]);
        $authenticated_user = $this->actingAs($user);
        $this->factoryWithoutObservers(Staff::class)->create();
        $staff = Staff::first();

        $updated_staff_details = [
            'name' => 'Aliu Edited',
            'email' => 'aliuwaha23b@gmail.com',
            'age' => 29,
            'phone' => '0207361611',
            'address' => 'Shalom Estate Edited',
            'city' => 'Accra',
            'state' => 'Ghana',
            'country' => 'Ghana',
            'level' => 'Manager',
            'image' => $file = UploadedFile::fake()->image('avatar.jpg'),
            'user_id' => $user->id
        ];



        $authenticated_user->put("/staff/".$staff->id,$updated_staff_details);

        $staff = Staff::first();
        $this->assertEquals("Aliu Edited", $staff->user->name);
        $this->assertEquals("Shalom Estate Edited", $staff->address);
        $this->assertDatabaseHas('users', ['name' => "Aliu Edited"]);
        $this->assertDatabaseHas('staff', ['address' => "Shalom Estate Edited"]);

    }


    /** @test */
    public function an_authenticated_admin_can_delete_a_staff()
    {
        $user = $this->actingAs($this->factoryWithoutObservers(User::class)->create(['is_admin' => true]));

        $staff_auth_profile = $this->factoryWithoutObservers(User::class)->create([
            'name' => 'James',
            'email' => 'james@gmail.com'
        ]);

        $this->factoryWithoutObservers(Staff::class)->create([
            'address' => 'Wa Accra',
            'user_id' => $staff_auth_profile->id
        ]);

        $staff = Staff::first();

        $response = $user->delete('staff/'.$staff->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('users',['name' => 'James']);
        $this->assertDatabaseMissing('staff',['address' => 'Wa Accra']);


    }












}
