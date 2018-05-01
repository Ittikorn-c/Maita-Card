<?php

namespace App\Http\Controllers\reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportSupportController extends Controller
{
    protected $ageLabel = ["0-6", "7-12", "13-19", "20-39", "40-59", "> 60"];
    protected $genderLabel = ["male", "female"];

    protected function getPromotionsWithAvailable($shop_id){
        $today = date("Y-m-d");
        $promotions = Promotion::belongToShop($shop_id)
            ->select(DB::raw("promotions.*, (promotions.exp_date >= '$today') as 'available'"))
            ->get();
        return $promotions;
    }

    protected function getAgeIndex($age){
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
}
