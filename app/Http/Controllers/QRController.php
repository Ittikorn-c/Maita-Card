<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRController extends Controller
{
    //
    public function showQR($id, $title){
        //check gate for owner
        if(\Gate::allows("owner"))
            return redirect('/');
    	// qr as userid for reading

        //case em = branch qr
        if ($title === 'Branch'){
            $obj = \App\Branch::where('id', '=', $id)->first();
            $obj->shop;
            $id = $obj->checkin_code;
        }
        elseif ($title === 'My') {
            $obj = \App\User::where('id', '=', $id)->first();
        }
        else {
            $obj = \App\RewardHistory::where('reward_code', '=', $id)->first();
            $template_id = $obj->promotion->template_id;
            $obj = $obj->promotionDetail($template_id)->first();
        }
    	$qr = \QrCode::size(400)->generate($id);
    	return view('qr/qr', ['qr' => $qr, 'title' => $title, 'obj' => $obj]);
    }

    public function scanQR($id) {

        if(\Gate::allows("owner"))
            return redirect('/');

        // Get the currently authenticated user...
        $user = \Auth::user();
        $role = $user->role;

        //fix first
        // case customer
        // $user = \App\User::where('id', '=', 17)->first();
        // case employee
        // $user = \App\User::where('id', '=', 28)->first();

        $role = $user->role;

        return view('qr/scan', ['role' => $role, 'id' => $id]);
    }
}
