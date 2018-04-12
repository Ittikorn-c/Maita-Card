<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ini_set("memory_limit", "-1");  // unlimit database

        factory(App\User::class, 100)->create();
        factory(App\Shop::class, 10)->create();
        factory(App\Branch::class, 20)->create();
        factory(App\CardTemplate::class, 30)->create();
        factory(App\Card::class, 300)->create();
        factory(App\Promotion::class, 200)->create();
        factory(App\Employee::class, 30)->create();
        factory(App\CustomerCheckin::class, 200)->create();
        factory(App\RewardHistory::class, 300)->create();
        factory(App\UsageHistory::class, 1000)->create();
    }
}
