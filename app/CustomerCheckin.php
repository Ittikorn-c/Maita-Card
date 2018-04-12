<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCheckin extends Model
{
    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }
}
