<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Commune;
use App\Models\UserAddress;
use App\User;
use Faker\Generator as Faker;

$factory->define(UserAddress::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'commune_id' => Commune::all()->random()->id,
        'address' => $faker->address()
    ];
});
