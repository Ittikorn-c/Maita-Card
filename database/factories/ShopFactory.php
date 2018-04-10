<?php

use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    $shop_name = $faker->unique()->word();
    $owner_id = $faker->randomElement(
        App\User::where("role", "owner")->pluck("id")->toArray()
    );
    // $create_time = 
    return [
        "name" => $shop_name,
        "owner_id" => 
        "phone" => $faker->phoneNumber,
        "email" => $shop_name . "@example.com",
        "category" => $faker->randomElement([
            'restaurant','cafe','salon','fitness','mall','cinema'
        ]),
        "logo_img" => $shop_name . "-logo.jpg",

    ];
});
