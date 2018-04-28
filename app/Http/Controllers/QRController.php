<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRController extends Controller
{
    //
    public function showQR($uid){
    	// qr as userid for reading
    	$qr = \QrCode::size(400)->generate($uid);
    	return view('qr/qr', ['qr' => $qr]);
    }

    public function scanQR() {

        // Get the currently authenticated user...
        // $user = Auth::user();
        // $role = $user->role;

        //fix first
        // case customer
        // $user = \App\User::where('id', '=', 17)->first();
        // case employee
        $user = \App\User::where('id', '=', 1)->first();

        $role = $user->role;

        return view('qr/scan', ['role' => $role]);
    }
}
