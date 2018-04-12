<?php

use Faker\Generator as Faker;

$factory->define(App\Promotion::class, function (Faker $faker) {
    $template = $faker->randomElement(
        App\CardTemplate::all()->toArray()
    );
    if($template["style"] == "stamp")
        $point = $faker->numberBetween($min=1, $max=10);
    else
        $point = $faker->numberBetween($min=5, $max=1000);

    $created_at = $faker->dateTimeBetween($startDate=$template["created_at"]);
    $exp_date = $faker->dateTimeBetween($startDate="2018-01-01", $endDate="+2 years");
    return [
        "template_id" => $template["id"],
        "point" => $point,
        "reward_name" => $faker->sentence($nbWords=3),
        "reward_img" => "sample-reward.jpg",
        "condition" => $faker->realText(),
        "exp_date" => $exp_date,
        "created_at" => $created_at,
        "updated_at" => $created_at
    ];
});
