<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        'category_id' => $faker->unique()->randomDigit(5),
        'user_id' => $faker->unique()->randomDigit,
        'displayname' => $faker->unique()->firstNameMale,
        'description' => $faker->paragraph(100),
        'count_review' => $faker->unique()->randomDigit,
        'count_view' => $faker->unique()->randomDigit,
        'count' => $faker->unique()->randomDigit,
        'weight' => $faker->unique()->randomDigit,
        'price' => $faker->numberBetween(100000, 20000000),
        'image_item' => $faker->text(100),
        'promotion_item' => $faker->text(100),
        'additionalinfo' => $faker->text(100),
        'created_at' => $faker->dateTime($max = 'now'),
        'updated_at' => $faker->dateTime($max = 'now'),
    ];
});
