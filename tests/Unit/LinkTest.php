<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Link;
use App\LinkStats;
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

    public function test_add_link_stats()
    {
        $linkStats = factory(LinkStats::class, 1)->make(['user_id' => null]);
 
        $this->assertCount(1, $linkStats); 
    } 
    
    public function test_add_multi_stats_for_a_link()
    {
        $link = factory(Link::class, 1)->create()->first(); 

        $linkStats = factory(LinkStats::class, 10)->create([ 'link_id' => $link->id ]);
  
        $this->assertCount(10, $linkStats); 
        $this->assertCount(10, $link->linkStats); 
    }
    
}
