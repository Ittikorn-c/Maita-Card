<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //

    public function home($shop_id=null){
        if(!Auth::check())
            return redirect("/home");
        if(Auth::user()->role != "owner")        
            return redirect("/home");

        $shops = $this->getShops();
        if(!is_null($shop_id)){
            $shop = $shops->find($shop_id);
            if(is_null($shop))
                return redirect("/home");   // this user is not owner of request shop
        }else{
            $shop = $shops->first();
            if(is_null($shop))
                // TODO change redirect to owner management page
                return redirect("/home");   // this user does not have any shop
        }
        $data = [12, 19, 10, 5, 2, 3];
        return view("owner.report.home")
                    ->with("data", implode(",", $data))
                    ->with("shops", $shops)
                    ->with("shop", $shop);
    }

    private function getShops(){
        $owner = Auth::user();
        return $owner->shops;
    }
}
