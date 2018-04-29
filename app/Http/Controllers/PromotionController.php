<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Http\Request;

use Carbon\Carbon;

class PromotionController extends Controller
{

    public function showCardPromo($template_id){

        //check user that login is owner of this card
        if(\Gate::denies("view-reward", $template_id))
            return $this->redirectUnpermission();

        $promo = Promotion::where('template_id', '=', $template_id)->get();
        $today = new Carbon;
        return view('rewards/show', ['promos' => $promo, 'template_id' => $template_id, 'today' => $today]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $promo = Promotion::all();
        $today = new Carbon;
        return view('rewards/show', ['promos' => $promo, 'today' => $today]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show($template_id, $promotion_id)
    {

        // Get the currently authenticated user...
        $user = \Auth::user();

        if(\Gate::denies("view-reward", $template_id))
            return $this->redirectUnpermission();

        //fix first
        // case customer
        // $user = \App\User::where('id', '=', 30)->first();
        // case employee
        // $user = \App\User::where('id', '=', 1)->first();
        //
        // $promotion->cardTemplate;
        // $promotion->cards;

        $promotion = Promotion::find($promotion_id);

        $p = $promotion->cardTemplate->cards;

        $index = $p->search(\App\Card::where('user_id', '=', $user->id)->where('template_id', '=', $template_id)->first());

        $card = $p->get($index);

        return view('rewards/detail', ['promo' => $promotion, 'card' => $card]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
