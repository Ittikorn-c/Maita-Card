<?php

use Faker\Generator as Faker;

$factory->define(App\CustomerCheckin::class, function (Faker $faker) {
    echo "makeing customer checkin " . date("Y-m-d H:i:s") . "\n";
    $faker = \Faker\Factory::create();
    return [
        "user_id" => $faker->randomElement(
            App\User::all()->pluck("id")->toArray()
        ),
        "checkin_code" => $faker->lexify("CK?????")
    ];
});
