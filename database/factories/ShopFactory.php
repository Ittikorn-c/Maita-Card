<?php

use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    $shop_name = $faker->unique()->word();
    $owner = $faker->randomElement(
        App\User::owner()->get()->toArray()
    );
    $create_time = $faker->dateTimeBetween($startDate=$owner["created_at"]);
    return [
        "name" => $shop_name,
        "owner_id" => $owner["id"],
        "phone" => $faker->phoneNumber,
        "email" => $shop_name . "@example.com",
        "category" => $faker->randomElement([
            'restaurant','cafe','salon','fitness','mall','cinema'
        ]),
        "logo_img" => $shop_name . "-logo.jpg",
        "created_at" => $create_time,
        "updated_at" => $create_time
    ];
});
