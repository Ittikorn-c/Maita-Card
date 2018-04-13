<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function home(){
        $data = [12, 19, 10, 5, 2, 3];
        return view("owner.report.home")
                    ->with("data", implode(",", $data));
    }
}
