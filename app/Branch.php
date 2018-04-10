<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function shop(){
        return $this->belongsTo("App\Shop", "shop_id");
    }

    public function employees(){
        return $this->hasMany("App\Employee", "branch_id");
    }
}
