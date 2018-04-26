<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRController extends Controller
{
    //
    public function showQR($uid){
    	// qr as userid for reading
    	$qr = \QrCode::size(400)->generate('user?'.$uid);
    	return view('qr/qr', ['qr' => $qr]);
    }
}
