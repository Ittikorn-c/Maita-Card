<?php

use Faker\Generator as Faker;

$factory->define(App\UsageHistory::class, function (Faker $faker) {
    $card = $faker->randomElement(
        App\Card::all()->toArray()
    );
    $template = App\CardTemplate::find($card["template_id"]);
    if($template->style == "stamp")
        $point = $faker->numberBetween($min=1, $max=5);
    else
        $point = $faker->numberBetween($min=1, $max=100);
    $shop = $template->shop;
    $employee_id = $faker->randomElement(
        App\Shop::allEmployees($shop->id)->pluck("id")->toArray()
    );
    $created_at = $faker->dateTimeBetween($min=$card["created_at"]);
    return [
        "card_id" => $card["id"],
        "point" => $point,
        "employee_id" => $employee_id,
        "created_at" => $created_at,
        "updated_at" => $created_at
    ];
});
