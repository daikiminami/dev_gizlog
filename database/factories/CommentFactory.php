<?php

use Faker\Generator as Faker;
use App\Models\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,4),
        'question_id' => $faker->numberBetween(1,30),
        'comment' => $faker->text(100)
    ];
});
