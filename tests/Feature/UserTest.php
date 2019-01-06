<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }


//    /** @test */
//    public function an_authenticated_admin_can_visit_create_admin()
//    {
//        $user = $this->factoryWithoutObservers(User::class)->create();
//        $user = $this->actingAs($user);
//        $response = $user->get('/users/create');
//        $response->assertStatus(200);
//        $response->assertViewIs("new-admin");
//        $response->assertSeeText("Add New Admin");
//
//    }

//
//    /** @test */
//    public function an_authenticated_admin_can_create_new_admin()
//    {
//        $user = $this->factoryWithoutObservers(User::class)->create();
//        $user = $this->actingAs($user);
//        $new_user_details = [
//            'name' => "Aliu",
//            'email' => "aliuwahab@gmail.com",
//            'password' => bcrypt("password"),
//            'is_admin' => 1,
//        ];
//        $response = $user->post('/users',$new_user_details);
//        $response->assertStatus(302);
//        $this->assertDatabaseHas('users', $new_user_details);
//
//    }



    /** @test */
    public function an_authenticated_admin_can_view_all_admins()
    {
        $user = $this->factoryWithoutObservers(User::class)->create();
        $user = $this->actingAs($user);
        $this->factoryWithoutObservers(User::class, 5);
        $admin = $this->factoryWithoutObservers(User::class)->create([
            'name' => 'Aliu'
        ]);

        $response = $user->get('/users');
        $response->assertStatus(200);
        $response->assertViewIs("all-admin-members");
        $response->assertViewHas("admins");
        $response->assertSeeText("Aliu");

    }


//
//
//    /** @test */
//    public function an_authenticated_admin_can_visit_edit_admin_page()
//    {
//        $user = $this->factoryWithoutObservers(User::class)->create();
//        $user = $this->actingAs($user);
//
//        $user2 = $this->factoryWithoutObservers(User::class)->create([
//            'name' => 'Faiq'
//        ]);
//
//        $response = $user->get('/users/'.$user2->id.'/edit');
//        $response->assertStatus(200);
//        $response->assertViewIs("edit-admin");
//        $response->assertSeeText("Update Admin Profile");
//    }
//
//
//    /** @test */
//    public function an_authenticated_admin_can_update_own_profile()
//    {
//        $user = $this->factoryWithoutObservers(User::class)->create();
//        $user = $this->actingAs($user);
//        $user_to_edit = User::first();
//        $updated_user_details = [
//            'name' => "Aliu Edited",
//            'email' => "aliuwahab@gmail.com",
//            'password' => bcrypt("password"),
//            'is_super_admin' => 1,
//        ];
//        $response = $user->put('/users/'.$user_to_edit->id,$updated_user_details);
//        $response->assertStatus(302);
//        $this->assertDatabaseHas('users', $updated_user_details);
//
//    }




}
