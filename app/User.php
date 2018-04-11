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

    public function employee(){
        return $this->hasOne("App\Employee", "user_id");
    }

    public function shops(){
        return $this->hasMany("App\Shop", "owner_id");
    }
}

