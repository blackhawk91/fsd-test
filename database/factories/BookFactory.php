<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'author' => $faker->name,
        'title' => $faker->name,
        'year' => random_int(1128,2008),
        'language' => $faker->languageCode,
        'language_org' => $faker->languageCode,
    ];
});
