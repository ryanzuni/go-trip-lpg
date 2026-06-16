<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if (!$user->is_verified) {

                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun belum diverifikasi OTP.'
                ]);
            }

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
            'is_verified' => false,
        ]);

        Mail::raw(
            "Kode OTP GoTrip Anda: {$otp}\n\nBerlaku selama 5 menit.",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Verifikasi Akun GoTrip');
            }
        );

        session([
            'verify_email' => $user->email
        ]);

        return redirect()->route('otp.form');
    }

    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $email = session('verify_email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('register');
        }

        if ($user->otp !== $request->otp) {
            return back()->withErrors([
                'otp' => 'Kode OTP salah'
            ]);
        }

        if (now()->gt($user->otp_expires_at)) {
            return back()->withErrors([
                'otp' => 'OTP sudah kadaluarsa'
            ]);
        }

        $user->update([
            'is_verified' => true,
            'otp' => null,
            'otp_expires_at' => null
        ]);

        Auth::login($user);

        return redirect('/')
            ->with('success', 'Akun berhasil diverifikasi');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
