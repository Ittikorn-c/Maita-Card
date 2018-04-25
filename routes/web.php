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
});

Route::get("/storage/{filename}", "StorageController@show");
