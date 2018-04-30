<?php

namespace App\Http\Controllers;

use App\CustomerCheckin;
use Illuminate\Http\Request;

class CustomerCheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //check gate for owner
        if(\Gate::denies("customer-only"))
            return redirect('/');
        // Get the currently authenticated user...
        $user = \Auth::user();

        $uses = CustomerCheckin::checkAt($user->id)->get();

        return view('customers/checkin_his', ['uses' => $uses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CusctomerCheckin  $cusctomerCheckin
     * @return \Illuminate\Http\Response
     */
    public function show(CusctomerCheckin $cusctomerCheckin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CusctomerCheckin  $cusctomerCheckin
     * @return \Illuminate\Http\Response
     */
    public function edit(CusctomerCheckin $cusctomerCheckin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CusctomerCheckin  $cusctomerCheckin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CusctomerCheckin $cusctomerCheckin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CusctomerCheckin  $cusctomerCheckin
     * @return \Illuminate\Http\Response
     */
    public function destroy(CusctomerCheckin $cusctomerCheckin)
    {
        //
    }
}
