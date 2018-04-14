<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Promotion;
use App\UsageHistory;

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
        $exchangeData = $this->getBasicExchangeData($shop);
        $pointReceiveData = $this->getBasicPointReceiveData($shop);
        $pointAvailableData = $this->getBasicPointAvailableData($shop);
        return view("owner.report.home")
                    ->with("shops", $shops)
                    ->with("shop", $shop)
                    ->with("exchangeData", $exchangeData)
                    ->with("pointReceiveData", $pointReceiveData)
                    ->with("pointAvailableData", $pointAvailableData);
    }

    private function getShops(){
        $owner = Auth::user();
        return $owner->shops;
    }

    private function getBasicExchangeData($shop){
        $promotions = Promotion::belongToShop($shop->id)->available()->get();
        $label = [];
        $data = [];
        foreach ($promotions as $promotion) {
            array_push($label, $promotion->reward_name);
            array_push($data, $promotion->rewardHistories()->count());
        }

        return [
            "label" => $label,
            "data" => $data
        ];
    }

    private function getBasicPointReceiveData($shop){
        $times = UsageHistory::shopPointReceiveByTime($shop->id)->get();
        $label = [];
        $data = [];
        foreach($times as $time){
            array_push($label, $time->Hour);
            array_push($data, $time->time);
        }

        return [
            "label" => $label,
            "data" => $data
        ];
    }

    private function getBasicPointAvailableData($shop){
        $templates = $shop->cardTemplates;
        $bundle = [
            "label" => ["0-6", "7-12", "13-19", "20-39", "40-59", "> 60"],
            "data" => []
        ];
        foreach($templates as $template){
            $raw = $template->countAvailablePointByAge();
            $data = [0, 0, 0, 0, 0, 0];

            foreach ($raw as $age => $amt) {
                if($age <= 6)
                    $data[0] += $amt;
                elseif($age <= 12)
                    $data[1] += $amt;
                elseif($age <= 19)
                    $data[2] += $amt;
                elseif($age <= 39)
                    $data[3] += $amt;
                elseif($age <= 59)
                    $data[4] += $amt;
                else
                    $data[5] += $amt;
            }
            array_push($bundle["data"], [
                "name" => $template->name,
                "data" => $data
            ]);
        }

        return $bundle;
    }
}
