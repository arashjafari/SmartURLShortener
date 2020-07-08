<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Jenssegers\Agent\Agent;
use App\Link;
use App\LinkStats;
use App\User;

$factory->define(LinkStats::class, function (Faker $faker) {

    $agent = new Agent;  
    $agent->setUserAgent($faker->userAgent);
 
    return [ 
        'link_id' => factory(Link::class),
        'user_id' => factory(User::class),
        'ip' => $faker->ipv4, 
        'is_robot' => $agent->isRobot(), 
        'is_phone' => $agent->isPhone(), 
        'is_desktop' => $agent->isDesktop(), 
        'device_nmae' => $agent->device(), 
        'platform_name' => $agent->platform(), 
        'browser_name' => $agent->browser()

    ];
});
