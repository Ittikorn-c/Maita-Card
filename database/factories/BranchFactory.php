<?php

use Faker\Generator as Faker;

$factory->define(App\Branch::class, function (Faker $faker) {
    $shop = $faker->randomElement(
        Shop::all()->toArray()
    );
    $created_at = $faker->dateTimeBetween($min=$shop["created_at"]);
    $updated_at = $faker->dateTimeBetween($min=$created_at);
    return [
        "shop_id" => $shop["id"],
        "name" => $faker->city,
        "location" => $faker->latitude() . "," . $faker->longitude(),
        "address" => $faker->address,
        "description" => $faker->text(),
        "checkin_code" => $faker->lexify("CK?????"),
        "phone" => $faker->phoneNumber,
        "created_at" => $created_at,
        "updated_at" => $updated_at
    ];
});
