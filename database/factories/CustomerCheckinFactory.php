<?php

use Faker\Generator as Faker;

$factory->define(App\CustomerCheckin::class, function (Faker $faker) {
    return [
        "user_id" => $faker->randomElement(
            App\User::all()->pluck("id")->toArray()
        ),
        "checkin_code" => $faker->lexify("CK?????")
    ];
});
