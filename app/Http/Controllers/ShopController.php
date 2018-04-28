<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Promotion;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shops = Shop::all();
        return view('shops.index',['shops'=>$shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = ['restaurant','cafe','salon','mall','fitness','cinema'];
        return view('shops.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      $validateData = $request->validate([
          "shopname" => "min:6|max:20|unique:shops,name",
          "shopphone" => "max:10",
          "shopeamil" => "unique:shop,email|email",
          "shopcategory" => "required"
      ]);
        try {
          $shop = new Shop;
          $shop->name = $request->input("shopname");
          $shop->phone = $request->input("shopphone");
          $shop->email = $request->input("shopemail");
          $shop->category = $request->input("shopcategory");
          $shop->logo_img = "";
          $shop->owner_id = \Auth::user()->id;
          $shop->save();
          $image_name = $shop->id . "." . $request->shoplogo->extension();
          \Storage::disk('public')->put("shop/$image_name", file_get_contents($request->file("shoplogo")));
          $shop->logo_img = $image_name;
          $shop->save();
          return redirect("/maitahome/shops/allshops");
        } catch (\Exception $e) {
            return $e;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
      return view('shops.show',['shop'=>$shop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
        return view('shops.edit',['shop'=>$shop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
        $validateData = $request->validate([
            "shopname" => "min:6|max:20|unique:shops,name",
            "shopphone" => "max:10",
            "shopeamil" => "unique:shop,email|email",
            "shopcategory" => "required"
        ]);
          try {
            $shop->name = $request->input("shopname");
            $shop->phone = $request->input("shopphone");
            $shop->email = $request->input("shopemail");
            $shop->category = $request->input("shopcategory");
            $image_name = $shop->id . "." . $request->shoplogo->extension();
            \Storage::disk('public')->put("shop/$image_name", file_get_contents($request->file("shoplogo")));
            $shop->logo_img = $image_name;
            $shop->save();
            return redirect("/maitahome/shops/allshops");
          } catch (\Exception $e) {

          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
      $shop->delete();
      return redirect("/maitahome/shops/allshops");
    }

    public function showAllShop()
    {
      $shops = Shop::all();
      return view('shops.allShop',['shops'=>$shops]);
    }
    public function showRestaurant()
    {
      $shops = Shop::Restaurant()->get();
      return view('shops.index',['shops'=>$shops]);
    }
    public function showCafe()
    {
      $shops = Shop::Cafe()->get();
      return view('shops.index',['shops'=>$shops]);
    }
    public function showSalon()
    {
      $shops = Shop::Salon()->get();
      return view('shops.index',['shops'=>$shops]);
    }
    public function showFitness()
    {
      $shops = Shop::Fitness()->get();
      return view('shops.index',['shops'=>$shops]);
    }
    public function showCinema()
    {
      $shops = Shop::Cinema()->get();
      return view('shops.index',['shops'=>$shops]);
    }
    public function showMall()
    {
      $shops = Shop::Mall()->get();
      return view('shops.index',['shops'=>$shops]);
    }

    public function showPromoBy($shop_id)
    {
      //
      $shop = Shop::findOrfail($shop_id);
      $promotions = Promotion::belongToShop($shop_id)->get();

      return view('shops.showPromo',['promotions'=>$promotions,
                                    'shop'=>$shop]);
    }
}
