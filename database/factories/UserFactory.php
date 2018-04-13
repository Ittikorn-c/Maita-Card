<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    echo "makeing user " . date("Y-m-d H:i:s") . "\n";
    $faker = \Faker\Factory::create();
    $username = $faker->unique()->word . $faker->lexify("????");
    $fname = $faker->firstName();
    $lname = $faker->lastName();
    $create_time = $faker->dateTime();
    return [
        'username' => $username,
        'email' => $username . "@example.com",
        'password' => Hash::make("123456"), // secret
        'fname' => $fname,
        "lname" => $lname,
        "address" => $faker->address,
        "phone" => $faker->tollFreePhoneNumber,
        "birth_date" => $faker->dateTime($timezone="Asia/Bangkok"),
        "gender" => $faker->randomElement(["female", "male"]),
        "profile_img" => $username . ".jpg",
        "role" => $faker->randomElement([
            "customer", "customer", "customer",
            "employee", "employee",
            "owner"
        ]),
        "status" => "active",
        "facebook" => $fname . " " . $lname,
        "created_at" => $create_time,
        "updated_at" => $create_time
    ];
});
