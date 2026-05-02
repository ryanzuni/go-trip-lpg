@extends('layouts.user-app')

@section('title', 'Pembayaran')

@section('content')

<div class="min-h-screen bg-gray-50 py-16 px-6">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- LEFT: INFO BOOKING -->
        <div class="md:col-span-2 bg-white rounded-2xl shadow p-6">

            <h2 class="text-xl font-bold mb-6">Detail Pemesanan</h2>

            <div class="space-y-4 text-sm">

                <div>
                    <p class="text-gray-500">Nama</p>
                    <p class="font-semibold">{{ $booking->nama }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Email</p>
                    <p class="font-semibold">{{ $booking->email }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Telepon</p>
                    <p class="font-semibold">{{ $booking->telepon }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Jumlah Orang</p>
                    <p class="font-semibold">{{ $booking->jumlah_orang }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Tanggal</p>
                    <p class="font-semibold">{{ $booking->tanggal_booking }}</p>
                </div>

            </div>

        </div>

        <!-- RIGHT: PAYMENT -->
        <div class="bg-white rounded-2xl shadow p-6 h-fit sticky top-10">

            <h2 class="text-lg font-bold mb-4">Ringkasan Pembayaran</h2>

            <div class="flex justify-between text-sm mb-2">
                <span>Total Harga</span>
                <span>Rp {{ number_format($booking->total_harga,0,',','.') }}</span>
            </div>

            <hr class="my-4">

            <div class="flex justify-between text-xl font-bold text-blue-600">
                <span>Total Bayar</span>
                <span>Rp {{ number_format($booking->total_harga,0,',','.') }}</span>
            </div>

            <!-- BUTTON -->
            <button id="pay-button"
                class="w-full mt-6 bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                Bayar Sekarang
            </button>

            <p class="text-xs text-gray-400 mt-3 text-center">
                Pembayaran aman melalui Midtrans
            </p>

        </div>

    </div>
</div>

@endsection


@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btn = document.getElementById('pay-button');

        if (btn) {
            btn.onclick = function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location.href = "/booking-success/{{ $booking->id }}";
                    },
                    onPending: function(result) {
                        alert("Menunggu pembayaran");
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal");
                    }
                });
            };
        }
    });
</script>
@endsection