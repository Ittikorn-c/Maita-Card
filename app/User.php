<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    protected $fillable = [
        'username', 'email', 'password',
        'fname', 'lname', 'address',
        'phone', 'birth_date', "gender",
        "profile_img", "role", "status",
        "facebook"
    ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cards(){
        return $this->hasMany("App\Card", "user_id");
    }

    public function checkins(){
        return $this->hasMany("App\CustomerCheckin", "user_id");
    }

    public function rewardHistories(){
        return $this->hasMany("App\RewardHistory", "employee_id");
    }
    public function usageHistories(){
        return $this->hasMany("App\UsageHistory", "employee_id");
    }

    // public function employee(){
    //     return $this->hasOne("App\Employee", "user_id");
    // }

    public function shops(){
        return $this->hasMany("App\Shop", "owner_id");
    }

    public function scopeOwner($query){
        return $query->where("role", "owner");
    }

    public function scopeCustomer($query){
        return $query->where("role", "customer");
    }
    public function scopeEmployee($query){
        return $query->where("role", "employee");
    }
    public function scopeCustomersOf($query, $shop_id){
        return $query->join("cards", "cards.user_id", "=", "users.id")
                        ->join("card_templates", "card_templates.id", "=", "cards.template_id")
                        ->where("users.role", "customer")
                        ->where("card_templates.shop_id", $shop_id)
                        ->select("users.*")
                        ->distinct();
    }

    public function getNameAttribute(){
        return $this->fname . " " . $this->lname;
    }
    public function age(){
        $bdate = date_create($this->birth_date);
        $now = date_create(date("Y-m-d"));
        $age = date_diff($now, $bdate)->format("%y");
        return (int) $age;
    }
}

