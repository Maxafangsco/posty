<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    public function __construct()
    {
        $this->middleware(['guest']);
    }


    public function index(){
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //validate request 
        $this->validate($request,[
            'name' => 'required|max:225',
            'username' => 'required|max:225',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request -> name,
            'username' => $request -> username,
            'email' => $request -> email,
            'password' =>  Hash::make($request -> password),
        ]);

        // sign in 

       Auth::attempt($request->only('email','password'));
            // Authentication was successful...
       

        return redirect() ->route('dashboard');
      

    }
}
