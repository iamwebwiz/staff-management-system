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




}
