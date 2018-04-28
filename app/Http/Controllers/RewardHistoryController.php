<?php

namespace App\Http\Controllers;

use App\RewardHistory;
use App\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RewardHistoryController extends Controller
{
    public function index() {
        //$id = Auth::user()->id;
        $id = 10;
        $hand = Card::where('id', $id)->pluck('id')->toArray();
        $histories = RewardHistory::whereIn('card_id', $hand)->get();
        return view('customer.reward_history', compact('histories'));
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

        $promotion_id = $request->input('promotion_id');

		$reward_code = \Faker\Factory::create()->lexify(sprintf("RW%07s?????", base_convert($promotion_id, 10, 36)));

        $reward_history = new RewardHistory;
        $reward_history->reward_code = $reward_code;
        $reward_history->card_id = $request->input('card_id');
        $reward_history->promotion_id = $promotion_id;

        $reward_history->save();

        return redirect('/home');

    }
}
