<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Shop;
use App\Promotion;
=======
use App\CardTemplate;
use App\Promotion;
use App\Shop;
>>>>>>> aff1bceed684d735dfce48e1d801da79af399c2e
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
<<<<<<< HEAD
        $shops = Shop::all();
        return view('shops.index',['shops'=>$shops]);
=======
>>>>>>> aff1bceed684d735dfce48e1d801da79af399c2e
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
<<<<<<< HEAD
        $categories = ['restaurant','cafe','salon','mall','fitness','cinema'];
        return view('shops.create',['categories'=>$categories]);
=======
>>>>>>> aff1bceed684d735dfce48e1d801da79af399c2e
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
      $validateData = $request->validate([
          "shopname" => "min:6|max:20|unique:shop,name",
          "shopphone" => "max:10",
          "shopeamil" => "unique:shop,email|email",
          "shopcategory" => "required"
      ]);
        try {
          $shop = new Shop;
          $shop->name = $request->input("shopname");
          $shop->phone = $request->intput("shopphone");
          $shop->email = $request->input("shopemail");
          $shop->category = $request->input("shopcategory");
          $shop->owner_id = 1;
          $shop->logo_img = "test-logo.jpg";
          // $shop->save();
          return redirect("/maitahome/allshops");
        } catch (\Exception $e) {

        }

=======
        //
>>>>>>> aff1bceed684d735dfce48e1d801da79af399c2e
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
<<<<<<< HEAD
      return view('shops.show',['shop'=>$shop]);
=======
        //
>>>>>>> aff1bceed684d735dfce48e1d801da79af399c2e
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
<<<<<<< HEAD
        return view('shops.edit',['shop'=>$shop]);
=======
>>>>>>> aff1bceed684d735dfce48e1d801da79af399c2e
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
<<<<<<< HEAD
        $validateData = $request->validate([
            "shopname" => "min:6|max:20|unique:shop,name",
            "shopphone" => "max:10",
            "shopeamil" => "unique:shop,email|email",
            "shopcategory" => "required"
        ]);
          try {
            $shop->name = $request->input("shopname");
            $shop->phone = $request->intput("shopphone");
            $shop->email = $request->input("shopemail");
            $shop->category = $request->input("shopcategory");
            $shop->owner_id = 1;
            $shop->logo_img = "test-logo.jpg";
            // $shop->save();
            return redirect("/maitahome/allshops");
          } catch (\Exception $e) {

          }
=======
>>>>>>> aff1bceed684d735dfce48e1d801da79af399c2e
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
<<<<<<< HEAD
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
=======
        //
    }


    /*------------ Promotion-combined Controller -----------*/
    public function isShopOwner($shop) {
        return true;
        if (\Auth::user()->id !== $shop->owner_id){
            return redirect('/');
        }
    }

    public function indexPromotion(Shop $shop){
        $this->isShopOwner($shop);

        $templates = CardTemplate::where('shop_id', $shop->id)->pluck('id')->toArray();
        $promotions = Promotion::whereIn('template_id', $templates)->get();

        return view('shop.promotion.index', compact('shop', 'promotions'));
    }

    public function showPromotion(Shop $shop, Promotion $promotion){
        $this->isShopOwner($shop);

        return view('shop.promotion.show', compact('shop','promotion'));
    }

    public function createPromotion(Shop $shop){
        $this->isShopOwner($shop);

        $cards = CardTemplate::where('shop_id', $shop->id)->pluck('name','id')->toArray();
        return view('shop.promotion.create', compact('shop', 'cards'));
    }

    public function storePromotion(Request $request, Shop $shop) {
        $request->validate([
            'reward_name' => ['required'],
            'reward_img' => ['required'],
            'condition' => ['required'],
            'template_id' => ['required'],
            'point' => ['required'],
        ]);

        $promotion = new Promotion;
        $promotion->reward_name = $request->input('reward_name');
        $promotion->reward_img = $request->input('reward_img');
        $promotion->condition = $request->input('condition');
        $promotion->template_id = $request->input('template_id');
        $promotion->point = $request->input('point');
        $promotion->save();
        return redirect("/shops/{$shop->id}/promotion/{$promotion->id}");
    }

    public function editPromotion(Shop $shop, Promotion $promotion) {
        $this->isShopOwner($shop);

        return view('shop.promotion.edit', compact('shop','promotion'));
    }

    public function updatePromotion(Request $request,Shop $shop, Promotion $promotion) {
        $this->isShopOwner($shop);

        $request->validate([
            'reward_name' => ['required'],
            'reward_img' => ['required'],
            'condition' => ['required'],
            'template_id' => ['required'],
            'point' => ['required'],
        ]);

        $promotion->reward_name = $request->input('reward_name');
        $promotion->reward_img = $request->input('reward_img');
        $promotion->condition = $request->input('condition');
        $promotion->template_id = $request->input('template_id');
        $promotion->point = $request->input('point');
        $promotion->save();
        return redirect("/shops/{$shop->id}/promotion/{$promotion->id}");
    }

    public function destroyPromotion(Shop $shop, $promotion) {
        $this->isShopOwner($shop);

        $promotion->delete();
        return redirect("/shops/{$shop->id}");
>>>>>>> aff1bceed684d735dfce48e1d801da79af399c2e
    }
}
