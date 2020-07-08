<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Link;
use Artisan;

class LinkTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp(); 
        Artisan::call('migrate:fresh');
    }
      
    public function test_add_link()
    {   
        $link = factory(Link::class, 1)->make();

        $this->assertCount(1, $link); 
    }
}
