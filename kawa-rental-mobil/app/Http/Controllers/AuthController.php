<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);

        // 🔹 Cek apakah user dengan email itu sudah ada
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Kalau akun dibuat lewat Google
            if ($user->provider === 'google') {
                return back()->with('failed', 'Akun ini terdaftar menggunakan Google. Silakan login dengan Google.');
            }
        }

        // 🔹 Login manual seperti biasa
        if (Auth::attempt($request->only('email', 'password'), true)) { // true = auto remember me aktif
            if (Auth::user()->role == 'customer') {
                return redirect('/landingpage');
            }
            return redirect('/admin');
        }

        return back()->with('failed', 'Email atau Password salah!');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
            'confirm_password' => 'required|max:50|same:password',
        ]);

        // 🔹 Cek apakah email sudah terdaftar
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            // Jika akun sudah ada dan dari Google
            if ($existingUser->provider === 'google') {
                return back()->with('failed', 'Email ini sudah terdaftar melalui Google. Silakan login dengan Google.');
            }

            // Jika akun manual sudah ada
            return back()->with('failed', 'Email sudah digunakan, silakan login.');
        }

        // 🔹 Buat akun baru
        $request['status'] = "verify";
        $request['provider'] = "manual";
        $user = User::create($request->all());
        Auth::login($user);
        return redirect('/landingpage');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
