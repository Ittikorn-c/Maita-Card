<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;

class MaitaHomeController extends Controller
{
    //
    public function index()
    {
      # code...
      $promotions = Promotion::all();
      return view('maitahome',['promotions'=>$promotions]);
    }
}
