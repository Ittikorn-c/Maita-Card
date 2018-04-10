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
}
