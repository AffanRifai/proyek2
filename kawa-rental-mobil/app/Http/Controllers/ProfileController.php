<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) return redirect('/login');
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => [
                'required', 'email', 'max:100',
                Rule::unique('users')->ignore($user->id),
            ],
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        // === HANDLE FOTO PROFIL ===
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = 'uploads/profile/' . $filename;

            // hapus file lama jika ada
            if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
                @unlink(public_path($user->profile_photo));
            }

            $file->move(public_path('uploads/profile'), $filename);
            $user->profile_photo = $path;
        }

        // === UPDATE INFO DASAR ===
        $user->name = $request->name;
        $user->email = $request->email;

        // === HANDLE PASSWORD ===
        if ($request->filled('current_password') || $request->filled('new_password')) {

            // Pastikan keduanya diisi
            if (!$request->filled('current_password') || !$request->filled('new_password')) {
                return back()->with('failed', 'Isi kedua field password saat ini dan password baru untuk mengganti password.');
            }

            // Cek password lama valid atau tidak
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('failed', 'Password saat ini tidak sesuai.');
            }

            // Jika valid → ganti password baru
            $user->password = Hash::make($request->new_password);
        }

        // === SIMPAN PERUBAHAN ===
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
