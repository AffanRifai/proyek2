<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);
        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            if (Auth::user()->role == 'customer') {
                return redirect('/landingpage'); // Redirect to customer dashboard or homepage
            }
            return redirect('/admin');
        }
        return back()->with('failed', 'Email atau Password salah!');
    }

    function register(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
            'confirm_password' => 'required|max:50|same:password',
        ]);

        $request['status'] = "verify";
        $user = \App\Models\User::create($request->all());
        Auth::login($user);
        return redirect('/landingpage');

    }

    public function logout(){
        Auth::logout(Auth::user());
        return redirect('/login');
    }
}
