<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Skill;
use Faker\Generator as Faker;

$names = collect(['HTML', 'CSS', 'JavaScript', 'PHP', 'Ruby', 'Python', 'Java', 'Go', 'Swift', 'Kotlin']);
$comments = collect(['簡単な使用が可能', '日常的に使用が可能']);

$factory->define(Skill::class, function (Faker $faker) use ($names, $comments) {
    return [
        'name' => $names->random(),
        'months_experience' => rand(6, 36),
        'comment' => $comments->random(),
    ];
});
