<?php

use Faker\Generator as Faker;

$factory->define(App\RewardHistory::class, function (Faker $faker) {
    echo "makeing reward history " . date("Y-m-d H:i:s") . "\n";
    $faker = \Faker\Factory::create();
    $promotion = $faker->randomElement(
        App\Promotion::all()->toArray()
    );
    // reward code define as RW#######??????
    //      # for promotion id in base 36 (can support for maximum promotion's id)
    //      ? for random alphobet (has variable value 26*26*26*26*26 = 11,881,376 value)
    // echo "selete promotion #" . $promotion["id"] . "\n";
    $reward_code = $faker->lexify(
        sprintf("RW%07s?????", base_convert($promotion["id"], 10, 36))
    );  
    $shop = App\Promotion::find($promotion["id"])->cardTemplate->shop;
    $created_at = $faker->dateTimeBetween($startDate=$promotion["created_at"], $endDate=$promotion["exp_date"]);
    return [
        "reward_code" => $reward_code,
        "card_id" => $faker->randomElement(
            App\Card::all()->pluck("id")->toArray()
        ),
        "promotion_id" => $promotion["id"],
        "employee_id" => $faker->randomElement(
            App\Shop::allEmployees($shop->id)->pluck("id")->toArray()
        ),
        "created_at" => $created_at,
        "updated_at" => $created_at

    ];
});
