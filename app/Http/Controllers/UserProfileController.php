<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $bookings = Booking::where('user_id', $user->id)
            ->with('paketWisata')
            ->latest()
            ->paginate(10);

        $totalBooking = Booking::where('user_id', $user->id)->count();

        $totalSuccess = Booking::where('user_id', $user->id)
            ->where('status', 'success')
            ->count();

        $totalPending = Booking::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $totalSpent = Booking::where('user_id', $user->id)
            ->where('status', 'success')
            ->sum('total_harga');

        return view('user.profile', compact(
            'user',
            'bookings',
            'totalBooking',
            'totalSuccess',
            'totalPending',
            'totalSpent'
        ));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
