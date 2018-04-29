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

        return redirect('/' . $reward_code .'/qr-code/Rewards');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RewardHistory  $reward_history
     * @return \Illuminate\Http\Response
     */
    public function checkoutRewardDetail($code)
    {
        //

        $reward_history = RewardHistory::where('reward_code', '=', $_POST['code'])->first();
        $reward_history->promotion->cardTemplate;

        $card = \App\Card::where('id', '=', $reward_history->card_id)->first();
        $card->user;

        return ['reward_id' => $reward_history->id, 'reward_name' => $reward_history->promotion->reward_name, 'username' => $card->user->username, 'point' => $reward_history->promotion->point];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        // Get the currently authenticated user...
        // $user = Auth::user();
        // $role = $user->role;

        //fix first
        // case customer
        // $user = \App\User::where('id', '=', 7)->first();
        // case employee
        $user = \App\User::where('id', '=', 28)->first();

        $reward_history = RewardHistory::where('id', '=', $request->input('uid'))->first();

        $branch_id = $request->input('bid');

        $em = \App\Employee::where('user_id', '=', $user->id)->where('branch_id', '=', $branch_id)->first();

        $reward_history->employee_id = $em->id;

        $reward_history->save();

        //point

        $card = \App\Card::where('id', '=', $reward_history->card_id)->first();

        $card->point = $card->point - $request->input('point');
        $card->save();

        return redirect('/' . $branch_id . '/scan');
    }

    //case already check but not scan yet
    public function checkHis($template_id){

    	// $card = Card::where('template_id', '=', $template_id)->where('user_id', '=', $user->id)->first();
    	// $card->cardTemplate;

    	$reward_history = RewardHistory::where('employee_id', '=', NULL)->promotionDetail($template_id)->get();

    	return view('/rewards/checknoscan', ['rewards' => $reward_history]);
    }
}
