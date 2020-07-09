<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class HomepageTest extends TestCase
{  
    public function test_homepage_accessible()
    {
        $response = $this->get('/'); 
        $response->assertStatus(200);  
    }

    public function test_users_can_access_their_own_dashboard_page()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('user.dashboard')); 
        $response->assertStatus(200);  
    }

    public function test_guest_can_not_access_dashboard_page()
    { 
        $response = $this->get(route('user.dashboard')); 
        $response->assertRedirect('/login');
    }

}
