<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketWisata;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $paket = PaketWisata::withCount('bookings')->paginate(9); // jumlah booking otomatis dihitung
        return view('user.paket.index', compact('paket'));
    }

    public function laporan(Request $request)
    {
        $query = Booking::query();

        if ($request->start && $request->end) {
            $query->whereBetween('created_at', [$request->start, $request->end]);
        }

        if ($request->paket_id) {
            $query->where('paket_id', $request->paket_id);
        }

        $bookings = $query->get();
        $pakets = PaketWisata::all(); // <-- Pastikan ini dikirim ke view

        return view('laporan.booking', compact('bookings','pakets'));
    }

    public function store(Request $request, PaketWisata $paket)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'jumlah_orang' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        Booking::create([
            'paket_id' => $paket->id,
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'telepon' => $validated['telepon'],
            'jumlah_orang' => $validated['jumlah_orang'],
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Pemesanan berhasil dikirim!');
    }
}
