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

    public function scopeAllEmployees($query, $shop_id){
        return DB::table("shops")
                    ->join("branches", "shops.id", "=", "branches.shop_id")
                    ->join("employees", "branches.id", "=", "employees.branch_id")
                    ->join("users", "employees.user_id", "=", "users.id")
                    ->select("users.*");
    }
}
