<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    echo "makeing employee " . date("Y-m-d H:i:s") . "\n";
    $faker = \Faker\Factory::create();
    return [
        "user_id" => $faker->randomElement(
            App\User::employee()->pluck("id")->toArray()
        ),
        "branch_id" => $faker->randomElement(
            App\Branch::all()->pluck("id")->toArray()
        )
    ];
});
