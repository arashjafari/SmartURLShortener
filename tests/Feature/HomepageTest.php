<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker; 
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Tests\TestCase;

class HomepageTest extends TestCase
{  

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_homepage_accessible()
    {
        $response = $this->get('/');

        $response->assertStatus(200); 

    }
}
