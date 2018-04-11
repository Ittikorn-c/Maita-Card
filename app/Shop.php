<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
