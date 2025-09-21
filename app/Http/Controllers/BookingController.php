<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketWisata;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $paket = PaketWisata::withCount('bookings')->paginate(9);
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

        $bookings = $query->with('paketWisata')->orderBy('tanggal_booking', 'desc')->paginate(10)->withQueryString();
        // $bookings = $query->with('paketWisata')->get();
        $pakets = PaketWisata::all();

        return view('laporan.booking', compact('bookings','pakets'));
    }

    // public function store(Request $request, PaketWisata $paket)
    // {
    //     $validated = $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'email' => 'required|email',
    //         'telepon' => 'required|string|max:20',
    //         'jumlah_orang' => 'required|integer|min:1',
    //         'tanggal_booking' => 'required|date', // <-- tambah input tanggal
    //         'catatan' => 'nullable|string',
    //     ]);

    //     // Tentukan harga berdasarkan hari booking
    //     $tanggal = Carbon::parse($validated['tanggal_booking']);
    //     $dayOfWeek = $tanggal->dayOfWeek; // 0 = Minggu, 6 = Sabtu

    //     if ($dayOfWeek == 0 || $dayOfWeek == 6) {
    //         // Weekend
    //         $harga = $paket->harga_weekend;
    //     } else {
    //         // Weekday
    //         $harga = $paket->harga_weekday;
    //     }

    //     Booking::create([
    //         'paket_id' => $paket->id,
    //         'nama' => $validated['nama'],
    //         'email' => $validated['email'],
    //         'telepon' => $validated['telepon'],
    //         'jumlah_orang' => $validated['jumlah_orang'],
    //         'tanggal_booking' => $validated['tanggal_booking'], // simpan tanggal booking
    //         'harga' => $harga * $validated['jumlah_orang'], // total harga
    //         'catatan' => $validated['catatan'] ?? null,
    //     ]);

    //     return redirect()->back()->with('success', 'Pemesanan berhasil dikirim!');
    // }

    // Hitung harga berdasarkan weekday/weekend
    public function store(Request $request, PaketWisata $paket)
    {
        // Validasi input user
        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'email'           => 'required|email',
            'telepon'         => 'required|string|max:20',
            'jumlah_orang'    => 'required|integer|min:1',
            'tanggal_booking' => 'required|date',
            'catatan'         => 'nullable|string',
        ]);

        // Tentukan weekday/weekend dari tanggal booking
        $tanggal   = Carbon::parse($validated['tanggal_booking']);
        $dayOfWeek = $tanggal->dayOfWeek; // 0 = Minggu, 6 = Sabtu

        // Ambil harga sesuai paket wisata
        $hargaSatuan = ($dayOfWeek == 0 || $dayOfWeek == 6)
            ? $paket->harga_weekend
            : $paket->harga_weekday;

        // Hitung total
        $totalHarga = $hargaSatuan * $validated['jumlah_orang'];

        // Simpan booking ke database
        $booking = Booking::create([
            'paket_id'        => $paket->id,
            'nama'            => $validated['nama'],
            'email'           => $validated['email'],
            'telepon'         => $validated['telepon'],
            'jumlah_orang'    => $validated['jumlah_orang'],
            'tanggal_booking' => $validated['tanggal_booking'],
            'harga_satuan'    => $hargaSatuan,
            'total_harga'     => $totalHarga,
            'catatan'         => $validated['catatan'] ?? null,
            'status'          => 'pending',
        ]);

        return redirect()->back()
            ->with('success', 'Pemesanan berhasil dikirim!')
            ->with('booking_id', $booking->id);
    }

}
