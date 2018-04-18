<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CardTemplate extends Model
{
    public function promotions(){
        return $this->hasMany("App\Promotion", "template_id");
    }

    public function cards(){
        return $this->hasMany("App\Card", "template_id");
    }

    public function shop(){
        return $this->belongsTo("App\Shop", "shop_id");
    }

    public function countAvailablePointByAge(){
        $cards = $this->cards;
        $ageCount = [];
        foreach ($cards as $card) {
            $user = $card->user;
            $age = $user->age();

            if(array_key_exists($age, $ageCount))
                $ageCount[$age] += 1;
            else
                $ageCount[$age] = 0;
        }

        return $ageCount;
    }
}
