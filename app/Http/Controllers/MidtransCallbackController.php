<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Transaksi;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        $orderId = $payload['order_id'];
        $status = $payload['transaction_status'];
        $fraud = $payload['fraud_status'];

        // ambil booking dari order_id
        $booking = Booking::where('id', $orderId)->first();

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // STATUS SUCCESS
        if ($status == 'settlement' || $status == 'capture') {

            $booking->update([
                'status' => 'success'
            ]);

            // update transaksi juga
            Transaksi::where('paket_id', $booking->paket_id)
                ->where('nama_pelanggan', $booking->nama)
                ->update([
                    'status' => 'success'
                ]);
        }

        // pending
        if ($status == 'pending') {
            $booking->update([
                'status' => 'pending'
            ]);
        }

        // gagal / cancel
        if ($status == 'cancel' || $status == 'expire') {
            $booking->update([
                'status' => 'batal'
            ]);
        }

        return response()->json(['message' => 'OK']);
    }
}