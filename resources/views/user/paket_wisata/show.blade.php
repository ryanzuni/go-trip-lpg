@extends('layouts.user-app')

@section('title', $paket->nama_paket)

@section('content')

@section('banner')
@if($paket->foto)
<div class="relative w-screen h-[570px] left-1/2 -translate-x-1/2 -mt-[15px]">
    <img src="{{ asset('storage/'.$paket->foto) }}"
        alt="{{ $paket->nama_paket }}"
        class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- TEXT -->
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-3">
            {{ $paket->nama_paket }}
        </h1>

        <!-- DESTINASI -->
        @if($paket->destinasi && $paket->destinasi->count())
        <div class="flex flex-wrap justify-center gap-2">
            @foreach($paket->destinasi as $d)
            <span class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-sm">
                {{ $d->nama }}
            </span>
            @endforeach
        </div>
        @else
        <p class="text-sm opacity-80">Tidak ada destinasi</p>
        @endif

        <p class="mt-3 text-lg opacity-90">
            {{ $paket->durasi_hari }} Hari
        </p>
    </div>

    <!-- HARGA -->
    <div class="absolute top-5 right-5 bg-white text-blue-600 px-5 py-2 rounded-full font-bold shadow-lg">
        Weekday: Rp {{ number_format($paket->harga_weekday,0,',','.') }}
    </div>
</div>
@endif
@endsection

<!-- CONTENT -->
<section class="py-16 px-6 bg-white">
    <div class="max-w-6xl mx-auto">

        <!-- INFO -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

            <!-- DESTINASI -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm">
                <p class="text-gray-500 text-sm mb-2">Destinasi</p>

                @if($paket->destinasi && $paket->destinasi->count())
                <div class="flex flex-wrap gap-2">
                    @foreach($paket->destinasi as $d)
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded-full">
                        {{ $d->nama }}
                    </span>
                    @endforeach
                </div>
                @else
                <p class="text-gray-400">Tidak ada destinasi</p>
                @endif
            </div>

            <!-- DURASI -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm">
                <p class="text-gray-500 text-sm">Durasi</p>
                <p class="text-xl font-bold">{{ $paket->durasi_hari }} Hari</p>
            </div>

            <!-- HARGA -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm">
                <p class="text-blue-600 font-bold">
                    Weekday: Rp {{ number_format($paket->harga_weekday,0,',','.') }}
                </p>
                <p class="text-green-600 font-bold">
                    Weekend: Rp {{ number_format($paket->harga_weekend,0,',','.') }}
                </p>
            </div>

        </div>

        <!-- DESKRIPSI -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Deskripsi Paket</h2>
            <p class="text-gray-700 leading-relaxed">
                {!! nl2br(e($paket->deskripsi ?? 'Deskripsi belum tersedia')) !!}
            </p>
        </div>

        <!-- FASILITAS (🔥 FIX UTAMA) -->
        @if($paket->fasilitas)
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Fasilitas</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach(explode(',', $paket->fasilitas) as $f)
                <div class="flex items-center gap-2 bg-gray-50 p-3 rounded-xl shadow-sm">
                    <span class="text-green-500">✔</span>
                    <span class="text-gray-700 text-sm">{{ trim($f) }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- ITINERARY -->
        @if($paket->itinerary)
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Itinerary</h2>

            <div class="space-y-4">
                @foreach(explode("\n", $paket->itinerary) as $i => $hari)
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-blue-600 text-white flex items-center justify-center rounded-full">
                        {{ $i+1 }}
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl flex-1">
                        {{ $hari }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- BUTTON -->
        <div x-data="{ openModal: false }">

            <!-- BUTTON -->
            @guest
            <a href="{{ route('login') }}"
                class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow">
                Login / Daftar Untuk Booking
            </a>
            @endguest

            @auth
            <button @click="openModal = true"
                class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow">
                Pesan Sekarang
            </button>
            @endauth

            <!-- MODAL -->
            <div x-show="openModal"
                x-transition
                class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">

                <div @click.away="openModal = false"
                    class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

                    <!-- LEFT: INFO PAKET -->
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 text-white p-6 flex flex-col justify-between">

                        <div>
                            <h2 class="text-2xl font-bold mb-2">
                                {{ $paket->nama_paket }}
                            </h2>

                            <!-- DESTINASI -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($paket->destinasi ?? [] as $d)
                                <span class="bg-white/20 px-2 py-1 rounded-full text-xs">
                                    {{ $d->nama }}
                                </span>
                                @endforeach
                            </div>

                            <p class="text-sm opacity-90">
                                {{ $paket->durasi_hari }} Hari
                            </p>
                        </div>

                        <!-- PRICE -->
                        <div class="mt-6">
                            <p class="text-sm opacity-80">Harga mulai dari</p>
                            <p class="text-2xl font-bold">
                                Rp {{ number_format($paket->harga_weekday,0,',','.') }}
                            </p>
                        </div>
                    </div>

                    <!-- RIGHT: FORM -->
                    <div class="p-6">

                        <h2 class="text-xl font-bold mb-5">Isi Data Pemesan</h2>

                        <form action="{{ route('booking.store', $paket->id) }}" method="POST" class="space-y-4">
                            @csrf

                            <input type="text" name="nama" placeholder="Nama Lengkap"
                                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>

                            <input type="email" name="email" placeholder="Email"
                                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>

                            <input type="text" name="telepon" placeholder="Nomor Telepon"
                                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>

                            <div class="grid grid-cols-2 gap-3">
                                <input type="number" name="jumlah_orang" placeholder="Jumlah Orang"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>

                                <input type="date" name="tanggal_booking"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                            </div>

                            <!-- TOTAL (STATIC FEEL TRAVELOKA) -->
                            <div class="bg-gray-50 p-4 rounded-xl mt-3">
                                <p class="text-sm text-gray-500">Estimasi Harga</p>
                                <p class="text-lg font-bold text-blue-600">
                                    Rp {{ number_format($paket->harga_weekday,0,',','.') }}
                                </p>
                            </div>

                            <!-- ACTION -->
                            <div class="flex justify-end gap-3 pt-4">
                                <button type="button" @click="openModal=false"
                                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                    Batal
                                </button>

                                <button type="submit"
                                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow">
                                    Booking Sekarang
                                </button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<!-- PAKET LAIN -->
<section class="py-16 px-6 bg-gray-50">
    <div class="max-w-6xl mx-auto">

        <h2 class="text-2xl font-bold mb-8">Paket Lainnya</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($paketLain as $item)
            <div class="group relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500">

                <!-- IMAGE -->
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ asset('storage/'.$item->foto) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <!-- GRADIENT OVERLAY -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                    <!-- DURASI BADGE -->
                    <span class="absolute top-4 left-4 bg-white/90 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full shadow">
                        {{ $item->durasi_hari }} Hari
                    </span>

                    <!-- PRICE -->
                    <div class="absolute bottom-3 right-3 bg-white text-blue-600 text-sm font-bold px-4 py-1 rounded-full shadow">
                        Rp {{ number_format($item->harga_weekday,0,',','.') }}
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="p-5">

                    <!-- TITLE -->
                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition">
                        {{ $item->nama_paket }}
                    </h3>

                    <!-- DESTINASI -->
                    <div class="flex flex-wrap gap-2 mt-3">
                        @if($item->destinasi && $item->destinasi->count())
                        @foreach($item->destinasi->take(3) as $d)
                        <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded-full">
                            {{ $d->nama }}
                        </span>
                        @endforeach

                        @if($item->destinasi->count() > 3)
                        <span class="text-xs text-gray-400">
                            +{{ $item->destinasi->count() - 3 }} lainnya
                        </span>
                        @endif
                        @else
                        <span class="text-xs text-gray-400">Tidak ada destinasi</span>
                        @endif
                    </div>

                    <!-- BUTTON -->
                    <a href="{{ route('paket.show', $item->id) }}"
                        class="block mt-5 text-center bg-gradient-to-r from-blue-600 to-blue-700 text-white py-2.5 rounded-xl font-semibold shadow-md hover:scale-[1.02] hover:shadow-xl transition">
                        Lihat Detail
                    </a>

                </div>

            </div>
            @endforeach

        </div>
    </div>
</section>

@endsection