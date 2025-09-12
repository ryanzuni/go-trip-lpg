<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    // Tampilkan halaman profil admin
    public function profile()
    {
        $user = Auth::user();
        return view('settings.profile', compact('user'));
    }

    // Update profil admin
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('settings.profile')->with('success','Profil berhasil diperbarui');
    }

    // Tampilkan form ubah password
    public function password()
    {
        return view('settings.password');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if(!Hash::check($request->current_password, $user->password)){
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('settings.password')->with('success','Password berhasil diperbarui');
    }
}
