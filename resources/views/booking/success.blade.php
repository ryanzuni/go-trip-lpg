@extends('layouts.user-app')

@section('title', 'Pembayaran Berhasil')

@section('content')

<div class="min-h-screen bg-slate-50 py-12">

    <div class="max-w-6xl mx-auto px-4">

        {{-- SUCCESS HEADER --}}
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl shadow-xl overflow-hidden">

            <div class="p-10 text-center text-white">

                <div class="w-24 h-24 mx-auto mb-5 rounded-full bg-white/20 flex items-center justify-center backdrop-blur">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-14 h-14"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="3"
                            d="M5 13l4 4L19 7" />

                    </svg>

                </div>

                <h1 class="text-4xl font-extrabold">
                    Pembayaran Berhasil
                </h1>

                <p class="mt-3 text-lg text-green-100">
                    Booking kamu telah berhasil dikonfirmasi
                </p>

                <div class="mt-6 inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/20 backdrop-blur">

                    <span class="w-2 h-2 bg-white rounded-full"></span>

                    Booking ID :
                    <span class="font-bold">
                        BOOK-{{ $booking->id }}
                    </span>

                </div>

            </div>

        </div>

        {{-- PROGRESS --}}
        <div class="bg-white rounded-3xl shadow-lg p-6 mt-6">

            <div class="flex flex-wrap justify-center items-center gap-4">

                <div class="flex items-center gap-2 text-green-600">
                    <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center">
                        ✓
                    </div>
                    <span class="font-medium">Pilih Paket</span>
                </div>

                <div class="w-12 h-1 bg-green-500 rounded"></div>

                <div class="flex items-center gap-2 text-green-600">
                    <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center">
                        ✓
                    </div>
                    <span class="font-medium">Isi Data</span>
                </div>

                <div class="w-12 h-1 bg-green-500 rounded"></div>

                <div class="flex items-center gap-2 text-green-600">
                    <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center">
                        ✓
                    </div>
                    <span class="font-medium">Pembayaran</span>
                </div>

                <div class="w-12 h-1 bg-green-500 rounded"></div>

                <div class="flex items-center gap-2 text-green-600">
                    <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center">
                        ✓
                    </div>
                    <span class="font-medium">Selesai</span>
                </div>

            </div>

        </div>

        {{-- CONTENT --}}
        <div class="grid lg:grid-cols-3 gap-6 mt-6">

            {{-- LEFT --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- DETAIL BOOKING --}}
                <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-8">

                    <h2 class="text-2xl font-bold mb-8">
                        Detail Booking
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-sm text-slate-500">
                                Nama Pemesan
                            </p>

                            <p class="font-semibold text-lg">
                                {{ $booking->nama }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">
                                Email
                            </p>

                            <p class="font-semibold">
                                {{ $booking->email }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">
                                Nomor Telepon
                            </p>

                            <p class="font-semibold">
                                {{ $booking->telepon }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">
                                Tanggal Keberangkatan
                            </p>

                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">
                                Jumlah Peserta
                            </p>

                            <p class="font-semibold">
                                {{ $booking->jumlah_orang }} Orang
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">
                                Status
                            </p>

                            <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                SUCCESS
                            </span>
                        </div>

                    </div>

                </div>

                {{-- INFORMASI PENTING --}}
                <div class="bg-blue-50 border border-blue-100 rounded-3xl p-8">

                    <h2 class="text-2xl font-bold text-blue-900 mb-6">
                        Informasi Penting
                    </h2>

                    <div class="space-y-4 text-blue-900">

                        <div class="flex items-start gap-3">
                            <span class="font-bold text-green-600">✓</span>
                            <p>
                                Booking berhasil dibuat dan pembayaran telah diterima.
                            </p>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="font-bold text-green-600">✓</span>
                            <p>
                                Invoice dapat diunduh kapan saja melalui tombol di samping.
                            </p>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="font-bold text-green-600">✓</span>
                            <p>
                                Tim GoTrip akan menghubungi Anda sebelum tanggal keberangkatan.
                            </p>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="font-bold text-green-600">✓</span>
                            <p>
                                Simpan Booking ID untuk mempermudah proses verifikasi.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div>

                <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">

                    @if($booking->paketWisata->foto)
                    <div class="h-56 overflow-hidden">

                        <img
                            src="{{ asset('storage/'.$booking->paketWisata->foto) }}"
                            class="w-full h-full object-cover">

                    </div>
                    @endif

                    <div class="p-6">

                        <h3 class="font-bold text-xl mb-5">
                            Ringkasan Paket
                        </h3>

                        <div class="space-y-4">

                            <div>
                                <p class="text-sm text-slate-500">
                                    Nama Paket
                                </p>

                                <p class="font-semibold">
                                    {{ $booking->paketWisata->nama_paket }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">
                                    Destinasi
                                </p>

                                <p>
                                    @if($booking->paketWisata->destinasi->count())
                                    {{ $booking->paketWisata->destinasi->pluck('nama')->join(', ') }}
                                    @else
                                    -
                                    @endif
                                </p>
                            </div>

                        </div>

                        <div class="border-t my-6"></div>

                        <div>

                            <p class="text-sm text-slate-500">
                                Total Pembayaran
                            </p>

                            <p class="text-3xl font-extrabold text-blue-600 mt-2">
                                Rp {{ number_format($booking->total_harga,0,',','.') }}
                            </p>

                        </div>

                    </div>

                </div>

                {{-- ACTION --}}
                <div class="mt-6 space-y-3">

                    <a href="{{ route('booking.invoice', $booking->id) }}"
                        class="w-full flex justify-center items-center bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-semibold shadow-lg transition">

                        Download Invoice

                    </a>

                    <a href="{{ route('paket.index') }}"
                        class="w-full flex justify-center items-center bg-white border border-slate-200 hover:bg-slate-50 py-4 rounded-2xl font-semibold transition">

                        Kembali ke Paket Wisata

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection