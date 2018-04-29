<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }

    public function branch(){
        return $this->belongsTo("App\Branch", "branch_id");
    }

    public function scopeAllBranch($query){
        return $query->join("branches", "employees.branch_id", "=", "branches.id")
                    ->join("shops", "branches.shop_id", "=", "shops.id")
                    ->select("employees.id", "employees.branch_id", "branches.shop_id", "branches.address", "branches.phone", "shops.name", "shops.logo_img");	
    }
}
