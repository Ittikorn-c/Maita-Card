<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsageHistory extends Model
{
    
    public function card(){
        return $this->belongsTo("App\Card", "card_id");
    }

    public function employee(){
        return $this->belongsTo("App\User", "employee_id");
    }

    public function scopeShopPointReceiveByTime($query, $shop_id){
        return $query->join("cards", "cards.id", "=", "usage_histories.card_id")
                    ->join("card_templates", "cards.template_id", "=", "card_templates.id")
                    ->where("card_templates.shop_id", $shop_id)
                    ->select(DB::raw("Hour(usage_histories.created_at) as 'Hour', count(*) as 'time'"))
                    ->groupBy('Hour');
    }

    public function scopeCheckedBy($query, $uid) {
        return $query->join('cards', 'cards.id', '=', 'usage_histories.card_id')
                        ->join('users', 'cards.user_id', '=', 'users.id')
                        ->join('employees', 'employees.id', '=', 'usage_histories.employee_id')
                        ->join('users as emusers', 'emusers.id', '=', 'employees.user_id')
                        ->join('branches', 'branches.id' ,'=', 'employees.branch_id')
                        ->join('shops', 'shops.id' ,'=', 'branches.shop_id')
                        ->where('emusers.id', '=', $uid)
                        ->orderBy('usage_histories.created_at', 'desc')
                        ->select('usage_histories.*', 'branches.name as branch_name', 'users.username', 'shops.name');
    }

    public function scopeUsed($query, $uid) {
        return $query->join('cards', 'cards.id', '=', 'usage_histories.card_id')
                        ->join('users', 'cards.user_id', '=', 'users.id')
                        ->join('employees', 'employees.id', '=', 'usage_histories.employee_id')
                        ->join('branches', 'branches.id' ,'=', 'employees.branch_id')
                        ->join('shops', 'shops.id' ,'=', 'branches.shop_id')
                        ->where('users.id', '=', $uid)
                        ->orderBy('usage_histories.created_at', 'desc')
                        ->select('usage_histories.*', 'branches.name as branch_name', 'users.username', 'shops.name');
    }

}
