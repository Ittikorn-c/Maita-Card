<?php

use Faker\Generator as Faker;

$factory->define(App\Card::class, function (Faker $faker) {
    echo "makeing card " . date("Y-m-d H:i:s") . "\n";
    $faker = \Faker\Factory::create();
    $template = $faker->randomElement(
        App\CardTemplate::all()->toArray()
    );
    $user = $faker->randomElement(
        App\User::all()->toArray()
    );
    if( $template["style"] == "stamp" )
        $point = $faker->numberBetween($min=0, $max=200);
    else
        $point = $faker->numberBetween($min=0, $max=2000);
    $checkin_point = $faker->numberBetween($min=0, $max=20);
    $exp_date = $faker->dateTimeBetween($startDate="2018-01-01", $endate="+2 years");
    $created_at = $faker->dateTimeBetween($startDate=$template["created_at"]);
    return [
        "user_id" => $user["id"],
        "template_id" => $template["id"],
        "point" => $point,
        "checkin_point" => $checkin_point,
        "exp_date" => $exp_date,
        "created_at" => $created_at
    ];
});
