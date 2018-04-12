<?php

use Faker\Generator as Faker;

$factory->define(App\Promotion::class, function (Faker $faker) {
    echo "makeing promotion " . date("Y-m-d H:i:s") . "\n";
    $faker = \Faker\Factory::create();
    $template = $faker->randomElement(
        App\CardTemplate::all()->toArray()
    );
    if($template["style"] == "stamp")
        $point = $faker->numberBetween($min=1, $max=10);
    else
        $point = $faker->numberBetween($min=5, $max=1000);

    $created_at = $faker->dateTimeBetween($startDate=$template["created_at"]);

    if($created_at < date("2018-01-01"))
        $exp_date = $faker->dateTimeBetween($startDate="2018-01-01", $endDate="+2 years");
    else 
        $exp_date = $faker->dateTimeBetween($startDate=$created_at, $endDate="+2 years");
    
    $reward_name = $faker->sentence($nbWords=3);
    $cond = $faker->text();

    return [
        "template_id" => $template["id"],
        "point" => $point,
        "reward_name" => $reward_name,
        "reward_img" => "sample-reward.jpg",
        "condition" => $cond,
        "exp_date" => $exp_date,
        "created_at" => $created_at,
        "updated_at" => $created_at
    ];
});
