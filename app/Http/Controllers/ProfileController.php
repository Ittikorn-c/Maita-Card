<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('profile.index', ['users' => $users]);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_profile = User::findOrFail($id);
        return view('profile.show', ['user' => $user_profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // if (\Auth::user()->cant('update', $user)) {
        //     return redirect('/profile');
        //     return $this->authorize('update', $user);
        // }

        $gender = [ 
            'male', 
            'female'];

        return view('profile.edit' , [
            'user' => $user,
            'gender' => $gender
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'address' => 'required|max:255|min:10',
            'phone' => 'required|max:20',
            'gender' => 'required',
            'username' => 'required|max:255|min:4|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[ 'fname.required' => 'The first name field is required.',
            'lname.required' => 'The last name field is required.'
        ]);

        $image_name = $user->username . "." . request()->avatar->getClientOriginalExtension();
        request()->avatar->storeAs('/public/profile/', $image_name);
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->profile_img = $image_name;
 
        $user->save();
        return redirect('/profile/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
