<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use Artisan;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call("migrate:fresh");
    }
    
    public function test_add_a_user()
    {
        $user = factory(User::class, 1)->make();

        $this->assertCount(1, $user);
    }
}
