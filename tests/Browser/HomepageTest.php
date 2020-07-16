<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Link;
use Artisan;

class HomepageTest extends DuskTestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp(); 
        Artisan::call('migrate:fresh');
    }
 
    private function getAppURL()
    {
        return Str::finish(config('app.url'), '/');
    }

    public function test_home_page_loads_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('shortened');
        });
    }

    public function test_i_can_make_a_short_link()
    {    
        $this->browse(function ($browser) {
            $browser->visit('/')
                    ->type('url', 'https://www.google.com')
                    ->type('customUrl', 'google')
                    ->press('Shorten URL')
                    ->assertPathIs('/')
                    ->assertSee($this->getAppURL() . 'google'); 
        
        }); 
    }

    public function test_i_can_open_a_short_link_and_redirect_to_main_link()
    {
        
        $link = Link::firstOrCreate(['ip' => '127.0.0.1', 'url' => 'https://www.google.com', 'custom' => 'google']);
 
        $this->browse(function ($browser) use ($link) {
            $browser->visit( $this->getAppURL() . $link->custom) 
                    ->assertHostIs("www.google.com"); 
        
        }); 
    }

}
