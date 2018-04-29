<?php

namespace App\Http\Controllers;

use App\UsageHistory;
use Illuminate\Http\Request;


class UsageController extends Controller
{

    public function emWorkHis()
    {

        //check gate for owner
        if(\Gate::denies("not-owner"))
            return $this->redirectUnpermission();
        // Get the currently authenticated user...
        $user = \Auth::user();

        $works = UsageHistory::checkedBy($user->id)->get();

        return view('employees/work_his', ['works' => $works]);

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

        // return view('qr/scan', ['role' => 'employee']);
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

        $request->validate([
            'bid' => 'required',
            'uid' => 'required',
            'point' => 'required,numeric'],
            [ 'bid.required' => 'Please Scan QR first',
            'uid.required' => 'Please Scan QR first',
            'point.required' => 'Please Enter Point',
            'point.numeric' => 'Please Enter Point as Number'
        ]);

        // Get the currently authenticated user...
        $user = \Auth::user();
        $role = $user->role;

        // still can't test fix first
        // $user = \App\User::where('id', '=', 1)->first();
        // $role = $request->input('role');

        //case employee scan
        if ($role === 'employee'){

            $em = \App\Employee::where('user_id', '=', $user->id)->where('branch_id', '=', $request->input('bid'))->first();
            $em->branch;

            // $branch = \App\Branch::where('id', '=', $em->branch_id)->first();

            $card = \App\Shop::where('shops.id', '=', $em->branch->shop_id)->usedCard($request->input('uid'))->first();

            //$card_id = \App\Card::where('user_id', '=', $request->input('uid'))->where()->first();

            // fix 
            $employee_id = $em->id;

            $usage = new UsageHistory;
            $usage->card_id = $card->id;
            $usage->point = $request->input('point');
            $usage->employee_id = $employee_id;

            $usage->save();
            return redirect('/' . $user->id . '/scan');            
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsageHistory  $usageHistory
     * @return \Illuminate\Http\Response
     */
    public function show(UsageHistory $usageHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsageHistory  $usageHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(UsageHistory $usageHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsageHistory  $usageHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsageHistory $usageHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsageHistory  $usageHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsageHistory $usageHistory)
    {
        //
    }
}
