<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MaitaHomeController@index');

Auth::routes();
Route::get("/confirmed/{user_id}", "Auth\RegisterController@confirmRegister");
Route::get("/after-register", function(){
    return view("auth.after-register");
});
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix("owner/report")->group(function(){
    Route::get("{shop_id?}", "ReportController@home");
    Route::get("exchange/promotion/{shop_id}", "ReportController@exchangePromotion");
    Route::get("exchange/age/{shop_id}", "ReportController@exchangeAge");
    Route::get("exchange/gender/{shop_id}", "ReportController@exchangeGender");

    Route::get("pointReceive/time/{shop_id}", "ReportController@pointReceiveTime");
    Route::get("pointReceive/age/{shop_id}", "ReportController@pointReceiveAge");
    Route::get("pointReceive/gender/{shop_id}", "ReportController@pointReceiveGender");

    Route::get("pointAvailable/age/{shop_id}", "ReportController@pointAvailableAge");
    Route::get("pointAvailable/gender/{shop_id}", "ReportController@pointAvailableGender");
});
Route::get('maitahome', 'MaitaHomeController@index');
Route::get('/maitahome/{promotion}','MaitaHomeController@show')->where('promotion','[0-9]+');


Route::get('/maitahome/shops', 'ShopController@index');
Route::get('/maitahome/shops/{shop}', 'ShopController@show')->where('shop','[0-9]+');;
Route::get('/maitahome/shops/allshops', 'ShopController@showAllShop');
Route::get('/maitahome/shops/create', 'ShopController@create');
Route::post('/maitahome/shops', 'ShopController@store');
Route::get('/maitahome/shops/{shop}/edit', 'ShopController@edit')->where('shop','[0-9]+');;
Route::put('/maitahome/shops/{shop}', 'ShopController@update');
Route::delete('/maitahome/shops/{shop}', 'ShopController@destroy');
Route::get('/maitahome/shops/restaurant', 'ShopController@showRestaurant');
Route::get('/maitahome/shops/cafe', 'ShopController@showCafe');
Route::get('/maitahome/shops/salon', 'ShopController@showSalon');
Route::get('/maitahome/shops/fitness', 'ShopController@showFitness');
Route::get('/maitahome/shops/cinema', 'ShopController@showCinema');
Route::get('/maitahome/shops/mall', 'ShopController@showMall');
Route::get('/maitahome/shops/{shop_id}/promotions', 'ShopController@showPromoBy')->where('shop_id','[0-9]+');



Route::get('/{id}/qr-code/{title}', 'QRController@showQR')->where('id', '[a-zA-Z0-9]+')->where('title', '[a-zA-Z]+');

Route::get('/{template_id}/rewards', 'PromotionController@showCardPromo')->where('template_id', '[0-9]+');

Route::get('/{template_id}/rewards/{promotion_id}', 'PromotionController@show')->where('template_id', '[0-9]+')->where('promotion_id', '[0-9]+');

Route::post('/{template_id}/rewards/{promotion_id}', 'RewardHistoryController@store')->where('template_id', '[0-9]+')->where('promotion_id', '[0-9]+');

Route::get('/{template_id}/rewards/myrewardsQR', 'RewardHistoryController@checkHis')->where('template_id', '[0-9]+');

Route::get('/{user}/work-his', 'UsageController@emWorkHis')->where('user', '[0-9]+');

Route::get('/{user}/scan', 'QRController@scanQR')->where('user', '[0-9]+');

Route::post('/scanforuser/{user}', 'ProfileController@getUName')->where('user', '[0-9]+');

Route::post('/scanforbranch/{code}', 'BranchController@getBName')->where('code', '[a-zA-Z0-9]+');

Route::post('/scanforreward/{code}', 'RewardHistoryController@checkoutRewardDetail')->where('code', '[a-zA-Z0-9]+');

Route::post('/escan', 'UsageController@store');

Route::put('/cscan', 'CardController@checkin');

Route::post('/rscan', 'RewardHistoryController@update');

Route::get('/profile', 'ProfileController@index');
Route::get('/profile/{id}', 'ProfileController@show')
    ->where('id' ,'[0-9]+');
Route::get('/profile/{user}/edit', 'ProfileController@edit')
    ->where('user' ,'[0-9]+');
Route::put('/profile/{user}', 'ProfileController@update')
    ->where('user' ,'[0-9]+');
Route::get('/employees', 'EmployeeController@index');


Route::resource('/shops', 'ShopController');
Route::get('/shops/{shop}/promotion', 'ShopController@indexPromotion');
Route::get('/shops/{shop}/promotion/{promotion}', 'ShopController@showPromotion')->where('promotion','[0-9]+');
Route::get('/shops/{shop}/promotion/create', 'ShopController@createPromotion');
Route::get('/shops/{shop}/promotion/{promotion}/edit', 'ShopController@editPromotion');
Route::put('/shops/{shop}/promotion/{promotion}', 'ShopController@updatePromotion');
Route::delete('/shops/{shop}/promotion/{promotion}',  'ShopController@destroyPromotion');
Route::post('/shops/{shop}/promotion', 'ShopController@storePromotion');


Route::get('/reward_history', 'RewardHistoryController@index');
Route::get('/cards/{card}', 'CardController@show')->where('card', '[0-9]+');
