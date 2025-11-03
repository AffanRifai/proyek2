<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // === STEP 1: Redirect user ke halaman login Google ===
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // === STEP 2: Callback setelah user login di Google ===
    public function callback()
    {
        try {
            // Ambil data dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            // Kalau user belum ada, buat baru langsung aktif tanpa OTP
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)),
                    'google_id' => $googleUser->getId(),
                    'provider' => 'google', // <--- tandai sebagai user Google
                    'is_verified' => true,   // <--- tandai sudah diverifikasi
                    'status' => 'active',    // <--- kalau kamu pakai kolom 'status'
                ]);
            }

            // Kalau user ada tapi belum aktif, langsung aktifkan
            if (isset($user->is_verified) && !$user->is_verified) {
                $user->update(['is_verified' => true]);
            }

            if (isset($user->status) && $user->status !== 'active') {
                $user->update(['status' => 'active']);
            }

            // Login otomatis dengan remember me aktif
            Auth::login($user, true);

            // Redirect ke landing page
            return redirect('/'); // ubah sesuai kebutuhan

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google: ' . $e->getMessage());
        }
    }
}
