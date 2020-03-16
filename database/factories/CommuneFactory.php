<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Commune;
use App\Models\Province;
use Faker\Generator as Faker;

$factory->define(Commune::class, function (Faker $faker) {
    return [
        'province_id' => Province::all()->random()->id,
        'name' => $faker->sentence(1),
    ];
});
