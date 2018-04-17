<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Promotion;
use App\UsageHistory;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //

    public function home($shop_id=null){
        $auth = $this->checkRoleAuth();
        if(!is_null($auth))
            return $auth;

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

    public function exchangePromotion($shop_id){
        $auth = $this->checkRoleAuth();
        if(!is_null($auth))
            return $auth;

        $shops = $this->getShops();
        $shop = $shops->find($shop_id);
        if(is_null($shop))
            return redirect("/home"); 

        $today = date("Y-m-d");
        $promotions = Promotion::belongToShop($shop->id)
                        ->select(DB::raw("promotions.*, (promotions.exp_date >= '$today') as 'available'"))
                        ->get();
        $label = [];
        $data = [];
        $available = [];
        foreach ($promotions as $promotion ) {
            array_push($label, $promotion->reward_name);
            array_push($data, $promotion->rewardHistories()->count());
            array_push($available, $promotion->available);
        }

        $bundle = [
            "label" => $label,
            "data" => $data,
            "available" => $available
        ];

        return view("owner.report.exchange-promotion")
                    ->with("bundle", $bundle)
                    ->with("promotions", $promotions);
        
    }
    // 
    public function exchangeAge($shop_id){
        $auth = $this->checkRoleAuth();
        if(!is_null($auth))
            return $auth;

        $shops = $this->getShops();
        $shop = $shops->find($shop_id);
        if(is_null($shop))
            return redirect("/home"); 

        $promotions = Promotion::belongToShop($shop_id)->get();
        $label = ["0-6", "7-12", "13-19", "20-39", "40-59", "> 60"];
        $datasets = [];
        foreach($promotions as $promotion){
            $exchanges = $promotion->rewardHistories;
            foreach($exchanges as $exchange){
                $user = $exchange->card->user;
                $age = $user->age();
                $data = [0, 0, 0, 0, 0, 0];
                
                if($age <= 6)
                    $data[0]++;
                elseif($age <= 12)
                    $data[1]++;
                elseif($age <= 19)
                    $data[2]++;
                elseif($age <= 39)
                    $data[3]++;
                elseif($age <= 59)
                    $data[4]++;
                else
                    $data[5]++;

                $dataset["$promotion->id"] = $data;
            }
        }
        $bundle = [
            "label" => $label,
            "dataset" => $dataset
        ];
        return view("owner.report.exchange-age")->with("bundle", $bundle);
    }

    private function checkRoleAuth(){
        if(!Auth::check())
            return redirect("/home");
        if(Auth::user()->role != "owner")        
            return redirect("/home");

        return null;
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
