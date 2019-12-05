<?php

use Faker\Generator as Faker;
use App\Models\DailyReport as Report;

$factory->define(Report::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(3, 10),
        'title' => $faker->text(15),
        'content' => $faker->text(100),
        'reporting_time' => $faker->DateTime->format('2019-m-d'),
    ];
});
