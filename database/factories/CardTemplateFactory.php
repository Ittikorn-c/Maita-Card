<?php

use Faker\Generator as Faker;

$factory->define(App\CardTemplate::class, function (Faker $faker) {
    $shop = $faker->randomElement(
        App\Shop::all()->toArray()
    );
    $created_at = $faker->dateTimeBetween($startDate=$shop["created_at"]);
    return [
        "shop_id" => $shop["id"],
        "name" => $faker->word,
        "img" => "sample-cardtemplate.jpg",
        "style" => $faker->randomElement([
            "stamp", "point"
        ]),
        "created_at" => $created_at,
        "updated_at" => $created_at
    ];
});
