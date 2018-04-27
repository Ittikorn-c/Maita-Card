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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

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

Route::get('/qr-code/{uid}', 'QRController@showQR')->where('uid', '[0-9]+');

Route::get('/rewards/{template_id}', 'PromotionController@showCardPromo')->where('template_id', '[0-9]+');

Route::get('/{user}/work-his', 'UsageController@emWorkHis')->where('user', '[0-9]+');

// Route::get('/scan', function () {
// 	return view('qr/scan');
// });

Route::get('/profile', 'ProfileController@index');
Route::get('/profile/{id}', 'ProfileController@show')
    ->where('id' ,'[0-9]+');


Route::resource('/shops', 'ShopController');
Route::put('/shops/{shop}/promotion/{promotion}', 'ShopController@updatePromotion');
Route::delete('/shops/{shop}/promotion/{promotion}',  'ShopController@destroyPromotion');
Route::post('/shops/{shop}/promotion', 'ShopController@storePromotion');


Route::get('/reward_history', 'RewardHistoryController@index');
Route::get('/card/{card}', 'CardController@show')->where('card', '[0-9]+');
