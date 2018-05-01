<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Htto\Controllers\reports\CardsSupportController;
use App\Htto\Controllers\reports\CheckinPointAvailableSupportController;
use App\Htto\Controllers\reports\CustomersSupportController;
use App\Htto\Controllers\reports\ExchangesSupportController;
use App\Htto\Controllers\reports\PointAvailableSupportController;
use App\Htto\Controllers\reports\PointReceiveSupportController;
use App\Shop;

class Report2Controller extends Controller{
    protected $cardsSupporter;
    protected $checkinPointAvailableSupporter;
    protected $customersSupporter;
    protected $exchangesSupporter;
    protected $pointAvailableSupporter;
    protected $pointReceiveSupporter;

    public function __construct(){
        $cardsSupporter = new CardsSupportController();
        $checkinPointAvailableSupporter = new CheckinPointAvailableSupportController;
        $customersSupporter = new CustomersSupportController;
        $exchangesSupporter = new ExchangesSupportController;
        $pointAvailableSupporter = new PointAvailableSupportController;
        $pointReceiveSupporter = new PointReceiveSupportController;
    }

    public function home($shop_id){
        $user_id = \Auth::user()->id;
        $shops = Shop::shopOwner($user_id);

        if(is_null($shop_id)){
            $shop = $shops->first();
            if(is_null($shop))
                return redirect("shops/create");
            $shop_id = $shop->id;
        }else{
            $shop = Shop::findOrFail($shop_id);
        }

        $exchangesPromotionDatasets = $exchangesSupporter->promotionDatasets($shop_id);
        $exchangesGenderDatasets = $exchangesSupporter->genderDatasets($shop_id);
        $exchangesAgeDatasets = $exchangesSupporter->getAgeDatasets($shop_id);
        
        $pointAvailableGenderDatasets = $pointAvailableSupporter->genderDatasets($shop_id);
        $pointAvailableAgeDatasets = $exchangesSupporter->getAgeDatasets($shop_id);
        
        $pointReceiveGenderDatasets = $pointReceiveSupporter->genderDatasets($shop_id);
        $pointReceiveAgeDatasets = $pointReceiveSupporter->getAgeDatasets($shop_id);

        $checkinPointAvailableGenderDatasets = $checkinPointAvailableSupporter->genderDatasets($shop_id);
        $checkinPointAvailableAgeDatasets = $checkinPointAvailableSupporter->getAgeDatasets($shop_id);
        
        $totalCustomer = $customersSupporter->getTotalCustomer();
        $totalCard = $cardsSupporter->getTotalCard();
        $totalExchange = $exchangesSupporter->getTotalExchange();

        return view("owner.report.home2", compact(
            "shops","shop_id",
            "exchangesPromotionDatasets","exchangesGenderDatasets","exchangesAgeDatasets",
            "pointAvailableGenderDatasets","pointAvailableAgeDatasets",
            "pointReceiveGenderDatasets","pointReceiveAgeDatasets",
            "checkinPointAvailableGenderDatasets","checkinPointAvailableAgeDatasets",
            "totalCustomer","totalCard","totalExchange"
        ));
    }
}