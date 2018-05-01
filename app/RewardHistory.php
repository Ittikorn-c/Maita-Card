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

    public function scopePromotionDetail($query, $template_id){
        return $query->join("promotions", "promotions.id", "=", "reward_histories.promotion_id")
                        ->join('card_templates', 'card_templates.id', '=', 'promotions.template_id')
                        ->join('shops', 'shops.id', '=', 'card_templates.shop_id')
                        ->where('card_templates.id', $template_id)
                        ->select("reward_histories.*", 'promotions.reward_name', 'promotions.reward_img', 'promotions.exp_date', 'shops.name');
    }

    public function scopeEmRewardHis($query, $uid){
        return $query->join('employees', 'employees.id', '=', 'reward_histories.employee_id')
                        ->join('cards', 'cards.id', '=', 'reward_histories.card_id')
                        ->join('users', 'users.id', '=', 'cards.user_id')
                        ->join("promotions", "promotions.id", "=", "reward_histories.promotion_id")
                        ->join('card_templates', 'card_templates.id', '=', 'promotions.template_id')
                        ->join('shops', 'shops.id', '=', 'card_templates.shop_id')
                        ->join('branches', 'branches.shop_id', '=', 'shops.id')
                        ->where('employees.user_id', '=', $uid)
                        ->orderBy('reward_histories.created_at', 'desc')
                        ->select('users.username', 'shops.name', 'branches.name as branch_name', 'promotions.reward_name', 'reward_histories.*');

    }
    
}
