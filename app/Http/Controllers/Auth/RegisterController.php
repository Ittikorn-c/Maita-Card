<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRegistration;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/after-register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except("confirmRegister");
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:6|max:20|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|digits:10',
            'birth_date' => 'required|date',
            'profile' => 'mimes:jpeg,bmp,png'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        echo "<script>console.log('". json_encode($data) ."')</script>";
        $image_name = $data["username"] . "." . $data["profile"]->getClientOriginalExtension();
        Storage::disk('public')->put("profile/$image_name", file_get_contents($data["profile"]));

        $user =  User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'fname' => $data["fname"],
            'lname' => $data["lname"],
            'address' => $data["address"],
            'phone' => $data["phone"],
            'birth_date' => $data["birth_date"],
            "gender" => $data["gender"],
            "profile_img" => $image_name,
            "role" => $data["role"],
            "status" => "inactive",
            "facebook" => $data["facebook"]
        ]);
        if(!strpos($data['email'], "@example.com"))
            $this->sendConfirmMail($user);
        return $user;
    }

    private function sendConfirmMail($user){
        return Mail::to($user)->send(new ConfirmRegistration($user));
    }

    public function confirmRegister($user_id){
        $user = User::findOrFail($user_id);
        if($user->status === "inactive")
            \Auth::login($user, true);
        $user->status = "active";
        $user->save();
        return view("auth.confirmed", ["user"=>$user]);
    }
}
