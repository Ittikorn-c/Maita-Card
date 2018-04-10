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
    
}
