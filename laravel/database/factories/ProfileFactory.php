<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'picture_filename' => $faker->url,
        'final_education' => $faker->city . '大学',
        'github_url' => $faker->url,
        'qiita_url' => $faker->url,
    ];
});
