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
        // ini_set("memory_limit", "-1");  // unlimit database

        // factory(App\User::class, 100)->create();
        // factory(App\Shop::class, 10)->create();
        // factory(App\Branch::class, 20)->create();
        // factory(App\CardTemplate::class, 30)->create();
        // factory(App\Card::class, 300)->create();
        // factory(App\Promotion::class, 200)->create();
        // factory(App\Employee::class, 30)->create();
        // factory(App\CustomerCheckin::class, 200)->create();
        // factory(App\RewardHistory::class, 300)->create();
        // factory(App\UsageHistory::class, 1000)->create();

        factory(App\User::class, 100)->create()->each(function($u){
            $u->role = "customer";
            $u->username = "customer" . $u->id;
            $u->email = "customer" . $u->id . "@example.com";
            $u->profile_img = $u->username . ".jpg";
            $u->save();
        });
        factory(App\User::class, 10)->create()->each(function($u){
            $u->role = "employee";
            $u->username = "employee" . $u->id;
            $u->email = "employee" . $u->id . "@example.com";
            $u->profile_img = $u->username . ".jpg";
            $u->save();
        });
        factory(App\User::class, 2)->create()->each(function($u){
            $u->role = "owner";
            $u->username = "owner" . $u->id;
            $u->email = "owner" . $u->id . "@example.com";
            $u->profile_img = $u->username . ".jpg";
            $u->save();
        });
        factory(App\Shop::class, 10)->create()->each(function($s){
            $s->logo_img = $s->id . ".jpg";
            $s->save();
        });
        factory(App\CardTemplate::class, 20)->create()->each(function($t){
            $t->img = $t->id . ".jpg";
            $t->save();
        });
        factory(App\Branch::class, 10)->create();
        factory(App\Employee::class, 10)->create();
        factory(App\Card::class, 300)->create();
        factory(App\Promotion::class, 100)->create()->each(function($p){
            $p->reward_img = $p->id . ".jpg";
            $p->save();
        });
        factory(App\UsageHistory::class, 1000)->create();
        factory(App\RewardHistory::class, 200)->create();
        factory(App\CustomerCheckin::class, 200)->create();
    }
}
