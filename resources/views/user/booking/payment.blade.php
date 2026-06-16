@extends('layouts.user-app')

@section('title', 'Pembayaran')

@section('content')

<div class="min-h-screen bg-gray-50 py-16 px-6">
    <div class="min-h-screen bg-slate-50">
        
        <div class="max-w-6xl mx-auto px-4 py-10">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">
                    Pembayaran Booking
                </h1>

                <p class="text-slate-500 mt-2">
                    Selesaikan pembayaran untuk mengamankan reservasi perjalanan Anda.
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-6">

                <!-- LEFT -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- STATUS -->
                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5">
                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                                ⏳
                            </div>

                            <div>
                                <h3 class="font-semibold text-amber-800">
                                    Menunggu Pembayaran
                                </h3>

                                <p class="text-sm text-amber-700">
                                    Booking telah dibuat dan menunggu pembayaran.
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- DETAIL PEMESAN -->
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">

                        <h2 class="text-xl font-bold mb-6">
                            Detail Pemesan
                        </h2>

                        <div class="grid md:grid-cols-2 gap-6">

                            <div>
                                <p class="text-sm text-slate-500">Nama Lengkap</p>
                                <p class="font-semibold text-slate-900">
                                    {{ $booking->nama }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Email</p>
                                <p class="font-semibold text-slate-900">
                                    {{ $booking->email }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Telepon</p>
                                <p class="font-semibold text-slate-900">
                                    {{ $booking->telepon }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Jumlah Peserta</p>
                                <p class="font-semibold text-slate-900">
                                    {{ $booking->jumlah_orang }} Orang
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Tanggal Berangkat</p>
                                <p class="font-semibold text-slate-900">
                                    {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">ID Booking</p>
                                <p class="font-semibold text-blue-600">
                                    BOOK-{{ $booking->id }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT -->
                <div>

                    <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-6 sticky top-24">

                        <h2 class="text-xl font-bold mb-5">
                            Ringkasan Pembayaran
                        </h2>

                        <div class="space-y-4">

                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Paket
                                </span>

                                <span class="font-medium text-right">
                                    {{ $booking->paketWisata->nama_paket }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Jumlah Orang
                                </span>

                                <span>
                                    {{ $booking->jumlah_orang }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Harga Satuan
                                </span>

                                <span>
                                    Rp {{ number_format($booking->harga_satuan,0,',','.') }}
                                </span>
                            </div>

                        </div>

                        <div class="border-t my-5"></div>

                        <div class="flex justify-between items-center">

                            <span class="text-lg font-semibold">
                                Total Bayar
                            </span>

                            <span class="text-3xl font-extrabold text-blue-600">
                                Rp {{ number_format($booking->total_harga,0,',','.') }}
                            </span>

                        </div>

                        <button
                            id="pay-button"
                            class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-2xl transition">

                            Bayar Sekarang

                        </button>

                        <div class="mt-5 text-center text-xs text-slate-400">
                            Pembayaran aman melalui Midtrans
                        </div>

                    </div>

                </div>

            </div>

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