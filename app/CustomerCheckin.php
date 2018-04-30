<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCheckin extends Model
{
    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }

    public function scopeCheckAt($query, $uid){
    	return $query->join('branches', 'branches.checkin_code', '=', 'customer_checkins.checkin_code')
    					->join('shops', 'shops.id', '=', 'branches.shop_id')
    					->where('customer_checkins.user_id', '=', $uid)
    					->select('shops.name', 'branches.name as branch_name', 'customer_checkins.*');
    }
}
