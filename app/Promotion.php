<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function cardTemplate(){
        return $this->belongsTo("App\CardTemplate", "template_id");
    }

    public function rewardHistories(){
        return $this->hasMany("App\RewardHistory", "promotion_id");
    }

    public function scopeOfShopCategory($query, $category){
        return $query->join("card_templates", "card_templates.id" , "=", "promotions.template_id")
                    ->join("shops", "shops.id", "=", "card_templates.shop_id")
                    ->where("shops.category", $category)
                    ->select("promotions.*");
    }

    public function scopeBelongToShop($query, $shop_id){
        return $query->join("card_templates", "promotions.template_id", "=", "card_templates.id")
                    ->join("shops", "card_templates.shop_id", "=", "shops.id")
                    ->where("shops.id", $shop_id)
                    ->select("promotions.*");
    }
    public function scopeAvailable($query){
        return $query->whereDate("promotions.exp_date", ">=", date("Y-m-d"));
    }
}
