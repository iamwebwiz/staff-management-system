<?php

namespace Tests\Feature;

use App\Staff;
use App\User;
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
        $user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($user);
        $response = $user->get('/staff/create');
        $response->assertStatus(200);
    }


    /** @test */
    public function an_authenticated_admin_can_create_a_staff()
    {
        Storage::fake('app/public/staff');
        $user = $this->factoryWithoutObservers(User::class)->create();
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
            'image' => $file = UploadedFile::fake()->image('avatar.jpg')
        ];

        $user->post("/staff",$staff_details);
        $staff = Staff::first();
        $this->assertDatabaseHas('staff', ['name' => "Aliu"]);
        $this->assertEquals("Aliu", $staff->name);

    }


    /** @test */
    public function an_authenticated_admin_can_view_a_staff()
    {
        $user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($user);
        $staff = $this->factoryWithoutObservers(Staff::class)->create([
            'name' => 'Aliu'
        ]);

        $response = $user->get("/staff/".$staff->id);
        $response->assertStatus(200);
        $response->assertSeeText($staff->name);
        $response->assertSeeText($staff->email);
        $response->assertSeeText($staff->phone);
    }




    /** @test */
    public function an_authenticated_admin_can_edit_a_staff()
    {
        $user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($user);
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
            'image' => $file = UploadedFile::fake()->image('avatar.jpg')
        ];

        $user->put("/staff/".$staff->id,$updated_staff_details);

        $staff = Staff::first();
        $this->assertEquals("Aliu Edited", $staff->name);
        $this->assertEquals("Shalom Estate Edited", $staff->address);
        $this->assertDatabaseHas('staff', ['name' => "Aliu Edited"]);
        $this->assertDatabaseHas('staff', ['address' => "Shalom Estate Edited"]);

    }


    /** @test */
    public function an_authenticated_admin_can_delete_a_staff()
    {
        $user = $this->actingAs($this->factoryWithoutObservers(User::class)->create());
        $this->factoryWithoutObservers(Staff::class)->create([
            'name' => 'James',
            'email' => 'james@gmail.com'
        ]);

        $staff = Staff::first();

        $response = $user->delete('staff/'.$staff->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('staff',['name' => 'James']);


    }












}
