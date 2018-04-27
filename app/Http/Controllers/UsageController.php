<?php

namespace App\Http\Controllers;

use App\UsageHistory;
use Illuminate\Http\Request;


class UsageController extends Controller
{

    public function emWorkHis($emid)
    {
        //
        $works = UsageHistory::where('employee_id', '=', $emid)->usedBy()->get();

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

        return view('qr/scan', ['role' => 'employee']);
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

        $role = $request->input('role');

        //case employee scan
        if ($role === 'employee'){

            $card_id = \App\Card::where('user_id', '=', $request->input('uid'))->first();

            // fix 
            $employee_id = 1;

            $usage = new UsageHistory;
            $usage->card_id = $card_id->id;
            $usage->point = $request->input('point');
            $usage->employee_id = $employee_id;

            $usage->save();
            return redirect('/' . $employee_id . '/scan');            
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
