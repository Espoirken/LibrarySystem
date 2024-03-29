<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'book_title' => $faker->company,
        'source' => $faker->name,
        'edition' => $faker->numberBetween($min = 1, $max = 4),
        'isbn' => $faker->numberBetween($min = 11000, $max = 19000),
        'category_id' => $faker->numberBetween($min = 1, $max = 4),
        'author' => $faker->name,
        'publisher_name' => $faker->name,
        'copyright_year' => $faker->year,
        'status' => $faker->randomElement(['Available', 'Borrowed', 'Weeded']),
    ];
});
