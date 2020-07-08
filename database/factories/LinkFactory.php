<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Link;
use App\User;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
 
    return [
        'user_id' => factory(App\User::class),
        'ip' => $faker->ipv4,
        'url' => $faker->url,
        'custom' => $faker->unique()->regexify('[A-Za-z0-9\-]{3,25}'),
        'total_uses' => null,
        'used' => 0,
        'expire_at' => null,
        'active' =>  true,
    ];
});
