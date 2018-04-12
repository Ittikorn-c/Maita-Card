<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        "user_id" => $faker->randomElement(
            App\User::employee()->pluck("id")->toArray()
        ),
        "branch_id" => $faker->randomElement(
            App\Branch::all()->pluck("id")->toArray()
        )
    ];
});
