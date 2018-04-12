<?php

use Illuminate\Database\Seeder;

class BigDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set("memory_limit", "-1");  // unlimit database

        factory(App\User::class, 1000)->create();
        echo "saving User to Database ...\n";

        factory(App\Shop::class, 30)->create();
        echo "saving Shop to Database ...\n";

        factory(App\Branch::class, 60)->create();
        echo "saving Branch to Database ...\n";

        factory(App\CardTemplate::class, 60)->create();
        echo "saving CardTemplate to Database ...\n";

        for ($i=0; $i < 3; $i++) { 
            factory(App\Card::class, 1000)->create();
            echo "saving Card to Database ...\n";
        }
        
        factory(App\Promotion::class, 500)->create();
        echo "savingPromotion to Database ...\n";

        factory(App\Employee::class, 150)->create();
        echo "saving Employee to Database ...\n";

        for ($i=0; $i < 2; $i++) { 
            factory(App\CustomerCheckin::class, 1000)->create();
            echo "saving CustomerChecking to Database ...\n";
        }
        
        for ($i=0; $i < 9; $i++) { 
            factory(App\RewardHistory::class, 1000)->create();
            echo "saving RewardHistory to Database ...\n";
        }
        
        for ($i=0; $i < 30; $i++) { 
            factory(App\UsageHistory::class, 1000)->create();
            echo "saving UsageHistory to Database ...\n";
        }
        
    }
}
