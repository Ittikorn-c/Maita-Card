<?php

namespace App\Http\Controllers;

use App\Card;
use App\CardTemplate;
use App\Shop;
use App\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Check In a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkin(Request $request) 
    {
        //

        // Get the currently authenticated user...
        // $user = Auth::user();
        // $role = $user->role;

        // still can't test fix first
        $user = User::where('id', '=', 17)->first();

        // case customer scan for check in branch
        if ($user->role === 'customer'){

            $shop = \App\Branch::where('id', '=', $request->input('bid'))->first()->shop;

            $card = Card::where('user_id', '=', $user->id)->cardsOf($shop->id)->first();

            // $card_id = \App\Card::where('user_id', '=', $user->id)->first();

            // // fix 
            // $employee_id = 1;

            $card->checkin_point = $card->checkin_point + $request->input('checkinPoint');

            // $usage = new UsageHistory;
            // $usage->card_id = $card_id->id;
            // $usage->point = $request->input('point');
            // $usage->employee_id = $employee_id;

            $card->save();
            return redirect('/' . $user->id . '/scan');               
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
/*        if (\Auth::user()->cant('view', $card)) {
            return redirect('/');
        }*/

        return view('card.detail', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
    }
}
