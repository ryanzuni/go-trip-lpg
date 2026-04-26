<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketWisata;
use App\Models\Booking;
use Carbon\Carbon;
use App\Notifications\BookingConfirmed;
use Illuminate\Support\Facades\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksi;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    public function index()
    {
        $paket = PaketWisata::withCount('bookings')->paginate(9);
        return view('user.paket.index', compact('paket'));
    }

    public function show($id)
    {
        $booking = Booking::with('paketWisata.destinasi')->findOrFail($id);

        $paket = $booking->paketWisata; // ambil paket dari relasi booking
        $paketLain = PaketWisata::where('id', '!=', $paket->id)->get();

        return view('booking.show', compact('paket', 'paketLain', 'booking'));
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

    public function confirmPayment($id)
    {
        $booking = Booking::findOrFail($id);

        // update status booking
        $booking->update([
            'status' => 'paid'
        ]);

        // simpan ke transaksi
        Transaksi::where('paket_id', $booking->paket_id)
            ->where('nama_pelanggan', $booking->nama)
            ->update([
                'status' => 'lunas'
            ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    public function payment($id)
    {
        $booking = Booking::with('paketWisata')->findOrFail($id);

        // pastikan belum dibayar
        if ($booking->status !== 'pending') {
            abort(403, 'Booking sudah diproses');
        }

        return view('user.booking.payment', compact('booking'));
    }

    public function success($id)
    {
        $booking = Booking::with('paketWisata.destinasi')->findOrFail($id);

        return view('booking.success', compact('booking'));
    }

    public function invoice($id)
    {
        $booking = Booking::with('paketWisata.destinasi')->findOrFail($id);

        $pdf = Pdf::loadView('booking.invoice', compact('booking'));

        return $pdf->download('invoice-booking-'.$booking->id.'.pdf');
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        // ambil data dari midtrans
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $signatureKey = $request->signature_key;

        // 🔐 VALIDASI SIGNATURE (WAJIB)
        $expectedSignature = hash('sha512',
            $orderId . $statusCode . $grossAmount . $serverKey
        );

        if ($signatureKey !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // ambil ID booking dari order_id
        // format: BOOK-1 → ambil 1
        $bookingId = str_replace('BOOK-', '', $orderId);

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // HANDLE STATUS MIDTRANS
        if ($request->transaction_status == 'settlement' || 
            $request->transaction_status == 'capture') {

            // update booking
            $booking->update([
                'status' => 'success'
            ]);

            // update transaksi
            $transaksi = Transaksi::where('paket_id', $booking->paket_id)
                ->where('nama_pelanggan', $booking->nama)
                ->latest()
                ->first();

            if ($transaksi) {
                $transaksi->update([
                    'status' => 'lunas'
                ]);
            }

        } elseif ($request->transaction_status == 'pending') {

            $booking->update([
                'status' => 'pending'
            ]);

        } elseif ($request->transaction_status == 'expire' || 
                $request->transaction_status == 'cancel') {

            $booking->update([
                'status' => 'batal'
            ]);
        }

        return response()->json(['message' => 'OK']);
    }

    public function store(Request $request, PaketWisata $paket)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'email'           => 'required|email',
            'telepon'         => 'required|string|max:20',
            'jumlah_orang'    => 'required|integer|min:1',
            'tanggal_booking' => 'required|date',
        ]);

        $tanggal   = \Carbon\Carbon::parse($validated['tanggal_booking']);
        $dayOfWeek = $tanggal->dayOfWeek;

        $hargaSatuan = ($dayOfWeek == 0 || $dayOfWeek == 6)
            ? $paket->harga_weekend
            : $paket->harga_weekday;

        $totalHarga = $hargaSatuan * $validated['jumlah_orang'];

        // SIMPAN BOOKING
        $booking = Booking::create([
            'paket_id'        => $paket->id,
            'nama'            => $validated['nama'],
            'email'           => $validated['email'],
            'telepon'         => $validated['telepon'],
            'jumlah_orang'    => $validated['jumlah_orang'],
            'tanggal_booking' => $validated['tanggal_booking'],
            'harga_satuan'    => $hargaSatuan,
            'total_harga'     => $totalHarga,
            'status'          => 'pending',
        ]);

        // SIMPAN TRANSAKSI
        Transaksi::create([
            'nama_pelanggan'     => $booking->nama,
            'paket_id'           => $booking->paket_id,
            'jumlah_orang'       => $booking->jumlah_orang,
            'tanggal_berangkat'  => $booking->tanggal_booking,
            'total_harga'        => $booking->total_harga,
            'status'             => 'pending',
        ]);

        // MIDTRANS CONFIG
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // PARAM MIDTRANS
        $params = [
            'transaction_details' => [
                'order_id' => 'BOOK-' . $booking->id,
                'gross_amount' => $booking->total_harga,
            ],
            'customer_details' => [
                'first_name' => $booking->nama,
                'email' => $booking->email,
                'phone' => $booking->telepon,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('user.booking.payment', compact('booking', 'snapToken'));
    }

}
