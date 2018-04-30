<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\CardTemplate;
use App\Promotion;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /*------------ Promotion-combined Controller -----------*/
    public function isShopOwner($shop) {
        /*return true;*/ //<<------------------------------- TRAP STATE FOR TEST
        if (\Auth::user()->id === $shop->owner_id and \Auth::user()->role === 'owner'){
            return true;
        }
        return false;
    }

    public function indexPromotion(Shop $shop){
        if(!$this->isShopOwner($shop)) {return redirect('/');}

        $templates = CardTemplate::where('shop_id', $shop->id)->pluck('id')->toArray();
        $promotions = Promotion::whereIn('template_id', $templates)->get();

        return view('shops.promotion.index', compact('shop', 'promotions'));
    }

    public function showPromotion(Shop $shop, Promotion $promotion){
        if(!$this->isShopOwner($shop) or $promotion->cardTemplate->shop_id !== $shop->id) {return redirect('/');}

        return view('shops.promotion.show', compact('shop','promotion'));
    }

    public function createPromotion(Shop $shop){
        if(!$this->isShopOwner($shop)) {return redirect('/');}

        $cards = CardTemplate::where('shop_id', $shop->id)->pluck('name','id')->toArray();
        return view('shops.promotion.create', compact('shop', 'cards'));
    }

    public function storePromotion(Request $request, Shop $shop) {
        $request->validate([
            'reward_name' => ['required'],
            'reward_img' => ['required'],
            'condition' => ['required'],
            'template_id' => ['required'],
            'point' => ['required'],
            'exp_date' => ['required'],
            'exp_time' => ['required'],
        ]);

        if(!$request->hasFile('reward_img')){
            return redirect("/shops/{$shop->id}/promotion/create");
        }

        $image_name = $request->file('reward_img')->getClientOriginalName();
        $image_name = time().$shop->id.'p.'.$request->file('reward_img')->getClientOriginalExtension();
        $request->reward_img->storeAs('promotions', $image_name, 'public');

        $promotion = new Promotion;
        $promotion->reward_img = $image_name;
        $promotion->reward_name = $request->input('reward_name');
        $promotion->condition = $request->input('condition');
        $promotion->template_id = $request->input('template_id');
        $promotion->point = $request->input('point');
        $promotion->exp_date = $request->input('exp_date').' '.$request->input('exp_time');
        $promotion->save();
        return redirect("/shops/{$shop->id}/promotion/{$promotion->id}");
    }

    public function editPromotion(Shop $shop, Promotion $promotion) {
        if(!$this->isShopOwner($shop) or $promotion->cardTemplate->shop_id !== $shop->id) {return redirect('/');}

        $cards = CardTemplate::where('shop_id', $shop->id)->pluck('name','id');
        return view('shops.promotion.edit', compact('shop','promotion', 'cards'));
    }

    public function updatePromotion(Request $request,Shop $shop, Promotion $promotion) {
        $request->validate([
            'reward_name' => ['required'],
            'condition' => ['required'],
            'template_id' => ['required'],
            'point' => ['required'],
            'exp_date' => ['required'],
            'exp_time' => ['required'],
        ]);

        if($request->hasFile('reward_img')) {
    /*        $image_name = $request->file('reward_img')->getClientOriginalName();*/
            $image_name = time().$shop->id.'p.'.$request->file('reward_img')->getClientOriginalExtension();
            $request->reward_img->storeAs('promotions', $image_name, 'public');
            $promotion->reward_img = $image_name;
        }

        $promotion->reward_name = $request->input('reward_name');
        $promotion->condition = $request->input('condition');
        $promotion->template_id = $request->input('template_id');
        $promotion->point = $request->input('point');
        $promotion->exp_date = $request->input('exp_date').' '.$request->input('exp_time');
        $promotion->save();
        return redirect("/shops/{$shop->id}/promotion/{$promotion->id}");
    }

    public function destroyPromotion(Shop $shop,Promotion $promotion) {
        $promotion->delete();
        return redirect("/shops/{$shop->id}/promotion");
    }

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
        if(Gate::allows("not-owner"))
            return $this->redirect("/maitahome");
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
        if(Gate::allows("not-owner"))
            return $this->redirect("/maitahome");
      $validateData = $request->validate([
          "shopname" => "min:6|max:20|unique:shops,name",
          "shopphone" => "max:10",
          "shopemail" => "unique:shops,email|email",
          "shopcategory" => "required",
          "shoplog" => "required"
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
            return back()->withInput();

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
        if(Gate::denies("view-shop", $shop))
            return $this->redirect("/maitahome");
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
        if(Gate::denies("view-shop", $shop))
            return $this->redirect("/maitahome");
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
        if(Gate::denies("view-shop", $shop))
            return $this->redirect("/maitahome");
        $validateData = $request->validate([
            "shopname" => "min:6|max:20|unique:shops,name,$shop->id",
            "shopphone" => "max:10",
            "shopemail" => "unique:shops,email,$shop->id|email",
            "shopcategory" => "required"
        ]);
          try {
            $shop->name = $request->input("shopname");
            $shop->phone = $request->input("shopphone");
            $shop->email = $request->input("shopemail");
            $shop->category = $request->input("shopcategory");
            $shop->logo_img = "";
            $shop->owner_id = \Auth::user()->id;
            $shop->save();
            if($request->file("shoplogo")){
                $image_name = $shop->id . "." . $request->shoplogo->extension();
                \Storage::disk('public')->put("shop/$image_name", file_get_contents($request->file("shoplogo")));
                $shop->logo_img = $image_name;
                $shop->save();
            }
            return redirect("/maitahome/shops/allshops");
          } catch (\Exception $e) {
              return back()->withInput();
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
        if(Gate::denies("view-shop", $shop))
            return $this->redirect("/maitahome");
      $shop->delete();
      return redirect("/maitahome/shops/allshops");
    }

    public function showAllShop()
    {
        if(Gate::allows("not-owner"))
            return $this->redirect("/maitahome");
      $shops = Shop::ShopOwner(\Auth::user()->id)->get();
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


    public function joinCard($shop_id){
        $shop = Shop::findOrFail($shop_id);
        $templates = $shop->cardTemplates;

        return view("customers.join_card", compact("templates", "shop"));
    }

    public function joinCardRegis(Request $request){
        $template_id = $request->input("template_id");
        $card = new \App\Card;
        $card->user_id = \Auth::user()->id;
        $card->template_id = $template_id;
        $card->point = 0;
        $card->checkin_point = 0;
        $card->exp_date = \Carbon\Carbon::now()->addYear(2);
        $card->save();
        return redirect("/profile/". \Auth::user()->id);

    public function showBranches($shop_id){
      //
      $branches = Shop::allBranch($shop_id)->get();

      return view('shops/branch', ['branches' => $branches]);

    }
}
