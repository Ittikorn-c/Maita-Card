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
            $bdate = date_create($user->birth_date);
            $now = date_create(date("Y-m-d"));
            $age = date_diff($now, $bdate)->format("%y");

            if(array_key_exists($age, $ageCount))
                $ageCount[$age]++;
            else
                $ageCount[$age] = 1;
        }

        return $ageCount;
    }
}
