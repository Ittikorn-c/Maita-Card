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
        return view('customers.reward_history', compact('histories'));
    }
}
