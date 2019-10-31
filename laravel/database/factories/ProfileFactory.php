<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Factory;
use Faker\Generator as Faker;

$specialty = collect(['フロントエンド', 'サーバーサイド', 'フルスタック', 'iOS', 'Android', 'モバイル', 'インフラストラクチャー', 'クラウド', 'ネットワーク']);

$factory->define(Profile::class, function (Faker $faker) use ($specialty) {
    $faker_en = Factory::create('en_US');

    return [
        'picture_filename' => $faker_en->lastname . '.jpg',
        'final_education' => $faker->city . '大学',
        'specialty' => $specialty->random(),
        'github_url' => $faker->url,
        'qiita_url' => $faker->url,
    ];
});
