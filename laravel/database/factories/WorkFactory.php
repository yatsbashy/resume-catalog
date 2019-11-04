<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Work;
use Faker\Generator as Faker;

$factory->define(Work::class, function (Faker $faker) {
    return [
        'started_at' => $faker->date(),
        'ended_at' => $faker->date(),
        'title' => $faker->sentence(),
        'description' => $faker->text(),
        'role' => $faker->word(),
        'scale' => $faker->numberBetween(1, 30),
    ];
});
