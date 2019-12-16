<?php

use Faker\Generator as Faker;
use App\Models\Question;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,4),
        'tag_category_id' => $faker->numberBetween(1,4),
        'title' => $faker->text(15),
        'content' => $faker->text(100)
    ];
});
