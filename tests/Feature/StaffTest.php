<?php

namespace Tests\Feature;

use App\Staff;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StaffTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_admin_can_visit_create_staff_page()
    {

    }


    /** @test */
    public function a_guest_cannot_visit_create_staff_page()
    {

    }



    /** @test */
    public function a_guest_cannot_create_a_staff()
    {
        $this->post('/add-new-staff')->assertRedirect('/login');
    }



    /** @test */
    public function an_authenticated_admin_can_create_a_staff()
    {
        //Given
        $this->actingAs(factory(User::class)->create());

        //When
        $staff_details = [
            'name' => 'Gbeila Aliu Wahab',
            'email' => 'aliuwaha23b@gmail.com',
            'age' => 29,
            'phone' => '0207361611',
            'image' => 'http://www.patriciashoppe.com/assets/Imag3.jpg',
            'address' => 'Shalom Estate',
            'city' => 'Accra',
            'state' => 'Ghana',
            'country' => 'Ghana',
            'level' => 'Manager',
        ];

        $response = $this->post("/add-new-staff",$staff_details);

        //Then
        $this->assertDatabaseHas('staff', ['name' => "Gbeila Aliu Wahab"]);
        $response->assertStatus(200)->assertRedirect("/all-staff-members");

    }


    /** @test */
    public function a_guest_cannot_visit_edit_staff_page()
    {

    }


    /** @test */
    public function an_authenticated_admin_can_visit_edit_staff_page()
    {

    }


    /** @test */
    public function a_guest_cannot_delete_staff()
    {

    }


    /** @test */
    public function an_authenticated_admin_can_delete_staff()
    {

    }




    /** @test */
    public function a_guest_cannot_see_all_staff()
    {

    }


    /** @test */
    public function an_authenticated_admin_can_see_all_staff()
    {

    }













}
