@extends('layouts.user-app')

@section('content')
<div class="max-w-3xl mx-auto py-16 px-6">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-green-600">
            Pembayaran Berhasil
        </h1>
        <p class="text-gray-500 mt-2">
            Booking kamu sudah dikonfirmasi
        </p>
    </div>

    <div class="bg-white shadow-xl rounded-2xl p-6">

        <h2 class="text-xl font-bold mb-4">Detail Booking</h2>

        <div class="space-y-2 text-sm">
            <p><b>Nama:</b> {{ $booking->nama }}</p>
            <p><b>Paket:</b> {{ $booking->paketWisata->nama_paket }}</p>
            <p>
                <b>Destinasi:</b>

                @if($booking->paketWisata->destinasi->count())
                {{ $booking->paketWisata->destinasi->pluck('nama')->join(', ') }}
                @else
                -
                @endif
            </p>
            <p><b>Tanggal:</b> {{ $booking->tanggal_booking }}</p>
            <p><b>Jumlah Orang:</b> {{ $booking->jumlah_orang }}</p>

            <p class="text-lg font-bold text-blue-600">
                Total: Rp {{ number_format($booking->total_harga,0,',','.') }}
            </p>

            <p class="text-green-600 font-bold">
                Status: SUCCESS
            </p>
        </div>

        <div class="flex gap-3 mt-8 justify-center">

            <a href="{{ route('booking.invoice', $booking->id) }}"
                class="px-5 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Download Invoice
            </a>

            <a href="{{ route('paket.index') }}"
                class="px-5 py-2 bg-gray-200 rounded-lg">
                Kembali
            </a>

        </div>

    </div>

</div>
@endsection