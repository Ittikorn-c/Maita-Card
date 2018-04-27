<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardHistory extends Model
{
    
    public function card(){
        return $this->belongsTo("App\Card", "card_id");
    }

    public function promotion(){
        return $this->belongsTo("App\Promotion", "promotion_id");
    }

    public function employee(){
        return $this->belongsTo("App\User", "employee_id");
    }

    public function scopeOfShop($query, $shop_id){
        return $query->join("cards", "cards.id", "=", "reward_histories.card_id")
                        ->join("card_templates", "card_templates.id", "=", "cards.template_id")
                        ->where("card_templates.shop_id", $shop_id)
                        ->select("reward_histories.*");
    }
    
}
