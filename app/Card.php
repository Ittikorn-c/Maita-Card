<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }

    public function cardTemplate(){
        return $this->belongsTo("App\CardTemplate", "template_id");
    }

    public function rewardHistories(){
        return $this->hasMany("App\RewardHistory", "card_id");
    }

    public function usageHistories(){
        return $this->hasMany("App\UsageHistory", "card_id");
    }
}
