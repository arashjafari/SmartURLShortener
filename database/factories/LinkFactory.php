<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
 
    return [
        'user_id' => null,
        'ip' => $faker->ipv4,
        'url' => $faker->url,
        'custom' => $faker->unique()->regexify('[A-Za-z0-9\-]{3,25}'),
        'total_uses' => null,
        'used' => 0,
        'expire_at' => null,
        'active' =>  true,
    ];
});
