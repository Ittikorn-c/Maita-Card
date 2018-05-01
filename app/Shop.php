<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shop extends Model
{
    public function branches(){
        return $this->hasMany("App\Branch", "shop_id");
    }

    public function cardTemplates(){
        return $this->hasMany("App\CardTemplate", "shop_id");
    }

    public function owner(){
        return $this->belongsTo("App\User", "owner_id");
    }

    public function scopeRestaurant($query){
      return $query->where("category", "restaurant");
    }
    public function scopeCafe($query){
      return $query->where("category", "cafe");
    }
    public function scopeSalon($query){
      return $query->where("category", "salon");
    }
    public function scopeFitness($query){
      return $query->where("category", "fitness");
    }
    public function scopeCinema($query){
      return $query->where("category", "cinema");
    }
    public function scopeMall($query){
        return $query->where("category", "mall");
      }
    public function scopeShopOwner($query, $user_id){
        return $query->join("users", "shops.owner_id", "=", "users.id")
                      ->where("shops.owner_id","=",$user_id)
                      ->select("shops.*");
    }
    public function scopeAllEmployees($query, $shop_id){
        return DB::table("shops")
                    ->join("branches", "shops.id", "=", "branches.shop_id")
                    ->join("employees", "branches.id", "=", "employees.branch_id")
                    ->join("users", "employees.user_id", "=", "users.id")
                    ->select("employees.*");
    }

    public function scopeUsedCard($query, $user_id) {
        return $query->join("card_templates", "card_templates.shop_id", "=", "shops.id")
                    ->join("cards", "cards.template_id", "=", "card_templates.id")
                    ->where("cards.user_id", '=', $user_id)
                    ->select('cards.id');
    }

    public function scopeAllBranch($query, $id){
        return $query->join("branches", "shops.id", "=", "branches.shop_id")
                    ->where("shops.id", "=", $id)
                    ->select("branches.id", "branches.address", "branches.phone", "branches.name", "shops.logo_img");  
    }
}
