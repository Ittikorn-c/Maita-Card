<?php

namespace App\Http\Controllers\reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\reports\ReportSupportController;
use App\Shop;
use App\Promotion;
use App\CardTemplates;

class ExchangesSupportController extends ReportSupportController
{
    public function getPromotionDatasets($shop_id){
        $shop = Shop::findOrFail($shop_id);
        $promotions = $this->getPromotionsWithAvailable($shop_id);

        return $promotions;
    }

    public function getGenderDatasets($shop_id){
        $shop = Shop::findOrFail($shop_id);
        $promotions = $this->getPromotionsWithAvailable($shop_id);
        $datasets = [];
        foreach($promotions as $promotion){
            $dataset = [
                "promotion" => $promotion,
                "data" =>  array_combine($this->genderLabel, array_fill(0, sizeof($this->genderLabel), 0))
            ];
            $exchanges = $promotion->rewardHistories;
            foreach ($exchanges as $exchange ) {
                $gender = $exchange->card->user->gender;
                $dataset["data"][$gender]++;
            }
            $datasets[$promotion->id] = $dataset;
        }
    }

    public function getAgeDatasets($shop_id){
        $promotions = $this->getPromotionsWithAvailable($shop_id);
        $datasets = [];
    }

    public function getTotalExchangeTime($shop_id){

    }
}
