<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardTemplate extends Model
{
    public function promotions(){
        return $this->hasMany("App\Promotion", "template_id");
    }

    public function cards(){
        return $this->hasMany("App\Card", "template_id");
    }

    public function shop(){
        return $this->belongsTo("App\Shop", "shop_id");
    }
}
