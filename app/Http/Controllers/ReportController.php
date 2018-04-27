<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Promotion;
use App\UsageHistory;
use App\Shop;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{

    public function home($shop_id=null){
        // $auth = $this->checkRoleAuth();
        // if(!is_null($auth))
        //     return $auth;

        // $shops = $this->getShops();
        // if(!is_null($shop_id)){
        //     $shop = $shops->find($shop_id);
        //     if(is_null($shop))
        //         return redirect("/home");   // this user is not owner of request shop
        // }else{
        //     $shop = $shops->first();
        //     if(is_null($shop))
        //         // TODO change redirect to owner management page
        //         return redirect("/home");   // this user does not have any shop
        // }
        if(is_null($shop_id)){
            $shop = Auth::user()->shops()->first();
            if(is_null($shop))
                return "not have any";    // TODO
        }else{
            $shop = Shop::findOrFail($shop_id);
        }
        
        if(Gate::denies("view-report", $shop))
            return $this->redirectUnpermission();
        $shops = $this->getShops();

        

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
        // $auth = $this->checkRoleAuth();
        // if(!is_null($auth))
        //     return $auth;

        // $shops = $this->getShops();
        // $shop = $shops->find($shop_id);
        // if(is_null($shop))
        //     return redirect("/home"); 
        $shop = Shop::findOrFail($shop_id);
        if(Gate::denies('view-report', $shop))
            return $this->redirectUnpermission();

        $promotions = $this->getPromotionsWithAvailable($shop_id);
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

        return view("owner.report.exchanges.promotion")
                    ->with("bundle", $bundle)
                    ->with("promotions", $promotions);
        
    }

    public function exchangeAge($shop_id){
        // $auth = $this->checkRoleAuth();
        // if(!is_null($auth))
        //     return $auth;

        // $shops = $this->getShops();
        // $shop = $shops->find($shop_id);
        // if(is_null($shop))
        //     return redirect("/home"); 
        $shop = Shop::findOrFail($shop_id);
        if(Gate::denies("view-report", $shop))
            return $this->redirectUnpermission();

        $promotions = $this->getPromotionsWithAvailable($shop_id);
        $label = ["0-6", "7-12", "13-19", "20-39", "40-59", "> 60"];
        $datasets = [];
        foreach($promotions as $promotion){
            $exchanges = $promotion->rewardHistories;
            $data = [0, 0, 0, 0, 0, 0];
            foreach($exchanges as $exchange){
                $user = $exchange->card->user;
                $age = $user->age();
                
                
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
            }
            $dataset["$promotion->id"] = [
                "label" => $promotion->reward_name,
                "data" => $data
            ];
        }
        $bundle = [
            "label" => $label,
            "dataset" => $dataset,
            "promotions" => $promotions
        ];
        return view("owner.report.exchanges.age", $bundle);
    }
    public function exchangeGender($shop_id){
        // $auth = $this->checkRoleAuth();
        // if(!is_null($auth))
        //     return $auth;

        // $shops = $this->getShops();
        // $shop = $shops->find($shop_id);
        // if(is_null($shop))
        //     return redirect("/home");  
        $shop = Shop::findOrFail($shop_id);
        if(Gate::denies("view-report", $shop))
            return $this->redirectUnpermission();

        $promotions = $this->getPromotionsWithAvailable($shop_id);

        $label = ["Male", "Female"];
        $datasets = [];
        foreach($promotions as $promotion){
            $exchanges = $promotion->rewardHistories;
            $dataset = [
                    "id" => $promotion->id,
                    "name" => $promotion->reward_name,
                    "data" => [
                        "male" => 0,
                        "female" => 0
                    ],
                    "available" => $promotion->available
                ];
            foreach($exchanges as $exchange){
                $gender = $exchange->card->user->gender;
                $dataset["data"][$gender]++;
            }
            $datasets[$promotion->id] = $dataset;
        }

        $bundle = [
            "label" => $label,
            "datasets" => $datasets
        ];

        return view("owner.report.exchanges.gender", $bundle);
    }

    public function pointReceiveTime($shop_id){
        // $auth = $this->checkRoleAuth();
        // if(!is_null($auth))
        //     return $auth;

        // $shops = $this->getShops();
        // $shop = $shops->find($shop_id);
        // if(is_null($shop))
        //     return redirect("/home");
        $shop = Shop::findOrFail($shop_id);
        if(Gate::denies("view-report", $shop))
            return $this->redirectUnpermission();

        $label = [];
        for ($i=0; $i < 24; $i++) { 
            array_push($label, $i);
        }
        $datasets = $this->getPointReceiveTime($shop_id);

        return view("owner.report.pointReceive.time", compact("label", "datasets"));
    }

    public function pointReceiveAge($shop_id){

        $shop = Shop::findOrFail($shop_id);
        if(Gate::denies("view-report", $shop))
            return $this->redirectUnpermission();

        $label = ["0-6", "7-12", "13-19", "20-39", "40-59", "> 60"];
        $datasets = $this->getPointReceiveAge($shop_id);

        return view("owner.report.pointReceive.age",compact("label", "datasets"));
    }

    public function pointReceiveGender($shop_id){

        $shop = Shop::findOrFail($shop_id);
        if(Gate::denies("view-report", $shop))
            return $this->redirectUnpermission();

        $label = ["male", "female"];
        $datasets = $this->getPointReceiveGender($shop_id);

        return view("owner.report.PointReceive.gender", compact("label", "datasets"));
    }

    public function pointAvailableAge($shop_id){

        $shop = Shop::findOrFail($shop_id);
        if(Gate::denies("view-report", $shop))
            return $this->redirectUnpermission();
        
        $label = ["0-6", "7-12", "13-19", "20-39", "40-59", "> 60"];
        $datasets = $this->getPointAvailableAge($shop_id);

        return view("owner.report.pointAvailable.age",compact("label", "datasets"));
    }

    public function pointAvailableGender($shop_id){
        $shop = Shop::findOrFail($shop_id);
        if(Gate::denies("view-report", $shop))
            return $this->redirectUnpermission();
        
        $label = ["male", "female"];
        $datasets = $this->getPointAvailableGender($shop_id);

        return view("owner.report.pointAvailable.gender",compact("label", "datasets"));
    }


    // ----------- helper method -----------
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

    private function getPromotionsWithAvailable($shop_id){
        $today = date("Y-m-d");
        $promotions = Promotion::belongToShop($shop_id)
            ->select(DB::raw("promotions.*, (promotions.exp_date >= '$today') as 'available'"))
            ->get();
        return $promotions;
    }

    public function getPointReceiveTime($shop_id){
        $raw = DB::table("shops")->join("card_templates", "card_templates.shop_id", "=", "shops.id")
                            ->join("cards", "cards.template_id", "=", "card_templates.id")
                            ->join("usage_histories", "usage_histories.card_id", "=", "cards.id")
                            ->select(DB::raw("card_templates.id, card_templates.name, Hour(usage_histories.created_at) as 'hour', sum(usage_histories.point) as 'point'"))
                            ->groupBy("hour", "card_templates.id")
                            ->where("shops.id", $shop_id)
                            ->get();
        $templates = Shop::find($shop_id)->cardTemplates;
        $datasets = [];
        foreach($templates as $template){
            $datasets[$template->id] = [
                "template_id" => $template->id,
                "template_name" => $template->name,
                "data" => []
            ];
        }
        foreach($raw as $data){
            $datasets[$data->id]["data"]["$data->hour"] = $data->point;
        }

        return $datasets;
    }

    public function getPointReceiveAge($shop_id){
        $shop = Shop::find($shop_id);
        $datasets = [];
        foreach ($shop->cardTemplates as $template) {
            $dataset = [
                "template_id" => $template->id,
                "template_name" => $template->name,
                "data" => [0, 0, 0, 0, 0, 0]
            ];
            foreach ($template->cards as $card) {
                $user = $card->user;
                $point = $card->usageHistories->sum('point');
                $age = $user->age();
                $dataset["data"][$this->getAgeIndex($age)] += $point;
            }
            $datasets[$template->id] = $dataset;
        }
        return $datasets;
    }

    public function getPointReceiveGender($shop_id){
        $shop = Shop::find($shop_id);
        $datasets = [];
        foreach ($shop->cardTemplates as $template) {
            $dataset = [
                "template_id" => $template->id,
                "template_name" => $template->name,
                "data" => [
                            "male" => 0,
                            "female" => 0
                        ]
            ];
            foreach ($template->cards as $card ) {
                $user = $card->user;
                $point = $card->usageHistories->sum('point');
                if($user->gender == "male")
                    $dataset["data"]["male"] += $point;
                else
                    $dataset["data"]["female"] += $point;
            }
            $datasets[$template->id] = $dataset;
        }
        return $datasets;
    }
    public function getPointAvailableAge($shop_id){
        $shop = Shop::find($shop_id);
        $datasets = [];
        $templates = $shop->cardTemplates;
        foreach($templates as $template){
            $dataset = [
                "template_id" => $template->id,
                "template_name" => $template->name,
                "data" => [0, 0, 0, 0, 0, 0]
            ];
            $cards = $template->cards;
            foreach($cards as $card){
                $user = $card->user;
                $dataset["data"][$this->getAgeIndex($user->age())] += $card->point;
            }
            $datasets[$template->id] = $dataset;
        }
        return $datasets;
    }
    public function getPointAvailableGender($shop_id){
        $shop = Shop::find($shop_id);
        $datasets = [];
        $templates = $shop->cardTemplates;
        foreach ($templates as $template) {
            $dataset = [
                "template_id" => $template->id,
                "template_name" => $template->name,
                "data" => [
                    "male" => 0,
                    "female" => 0
                ]
            ];
            $cards = $template->cards;
            foreach ($cards as $card ) {
                $user = $card->user;
                $dataset["data"][$user->gender] += $card->point;
            }
            $datasets[$template->id] = $dataset;
        }
        return $datasets;
    }

    private function getAgeIndex($age){
        if($age <= 6)
            return 0;
        elseif($age <= 12)
            return 1;
        elseif($age <= 19)
            return 2;
        elseif($age <= 39)
            return 3;
        elseif($age <= 59)
            return 4;
        else
            return 5;
    }

    private function redirectUnpermission(){
        return redirect("/home");
    }
}
