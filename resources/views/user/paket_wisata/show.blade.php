@extends('layouts.user-app')

@section('title', $paket->nama_paket)

@section('content')

<!-- Banner Full Width (nempel ke navbar) -->
@section('banner')
@if($paket->foto)
<div class="relative w-screen h-[570px] left-1/2 -translate-x-1/2 -mt-[15px]">
    <img src="{{ asset('storage/'.$paket->foto) }}" 
         alt="{{ $paket->nama_paket }}" 
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- Info di atas banner -->
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-lg mb-3">
            {{ $paket->nama_paket }}
        </h1>
        <p class="text-lg md:text-xl opacity-90">
            {{ $paket->destinasi->nama ?? 'Tidak ada destinasi' }} - {{ $paket->durasi_hari }} Hari
        </p>
    </div>

    <!-- Harga pojok kanan atas -->
    <span class="absolute top-4 right-4 bg-white/90 text-blue-600 text-sm md:text-base font-bold px-5 py-2 rounded-full shadow-lg">
        Rp {{ number_format($paket->harga,0,',','.') }}
    </span>
</div>
@endif

<!-- Konten Detail -->
<section class="py-16 px-6 bg-white">
    <div class="max-w-6xl mx-auto">
        
        <!-- Info Utama -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="flex items-center gap-4 bg-gray-50 p-6 rounded-2xl shadow-sm">
                <i class="bi bi-geo-alt text-blue-600 text-3xl"></i>
                <div>
                    <p class="text-gray-500 text-sm">Lokasi</p>
                    <p class="text-lg md:text-xl opacity-90">
                        {{ optional($paket->destinasi)->nama ?? '-' }} - {{ $paket->durasi_hari }} Hari
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-gray-50 p-6 rounded-2xl shadow-sm">
                <i class="bi bi-clock text-blue-600 text-3xl"></i>
                <div>
                    <p class="text-gray-500 text-sm">Durasi</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $paket->durasi_hari }} Hari</p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-gray-50 p-6 rounded-2xl shadow-sm">
                <i class="bi bi-cash-stack text-blue-600 text-3xl"></i>
                <div>
                    <!-- <p class="text-lg font-bold text-blue-600">
                        Harga Hari Ini: Rp {{ number_format($paket->harga_hari_ini, 0, ',', '.') }}
                    </p> -->
                    <p class="text-lg font-bold text-blue-600">
                        Weekday: Rp {{ number_format($paket->harga_weekday, 0, ',', '.') }}
                    </p>
                    <p class="text-lg font-bold text-green-600">
                        Weekend: Rp {{ number_format($paket->harga_weekend, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi Paket</h2>
            <p class="text-gray-700 leading-relaxed">
                {!! nl2br(e($paket->deskripsi ?? 'Deskripsi belum tersedia untuk paket ini.')) !!}
            </p>
        </div>

        <!-- Itinerary -->
        @if(!empty($paket->itinerary))
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Itinerary Perjalanan</h2>
            <div class="space-y-6">
                @foreach(explode("\n", $paket->itinerary) as $index => $hari)
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-600 text-white font-bold rounded-full shadow-md">
                            {{ $index+1 }}
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl shadow-sm flex-1">
                            <p class="text-gray-700">{{ $hari }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Tombol Aksi + Form Booking -->
    <!-- <div x-data="{ openForm: false }"> -->
        <!-- Tombol -->
        <div x-data="{ openModal: false }">

            <!-- BUTTON -->
            <button @click="openModal = true"
                class="px-6 py-3 bg-blue-600 text-white rounded-xl">
                Pesan Sekarang
            </button>

            <!-- MODAL -->
            <div x-show="openModal"
                x-transition
                class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

                <div @click.away="openModal = false"
                    class="bg-white w-full max-w-lg p-6 rounded-2xl shadow-lg">

                    <h2 class="text-xl font-bold mb-4">Booking Paket</h2>

                    <form action="{{ route('booking.store', $paket->id) }}" method="POST">
                        @csrf

                        <input type="text" name="nama" placeholder="Nama" class="w-full mb-3 p-2 border rounded" required>
                        <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded" required>
                        <input type="text" name="telepon" placeholder="Telepon" class="w-full mb-3 p-2 border rounded" required>
                        <input type="number" name="jumlah_orang" placeholder="Jumlah Orang" class="w-full mb-3 p-2 border rounded" required>
                        <input type="date" name="tanggal_booking" class="w-full mb-3 p-2 border rounded" required>

                        <div class="flex justify-end gap-2">
                            <button type="button" @click="openModal=false"
                                class="px-4 py-2 bg-gray-300 rounded">
                                Batal
                            </button>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                                Booking
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>


        <!-- Konten Lain / Paket Lainnya -->
        <section class="py-16 px-6 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-800 mb-8">Paket Lainnya</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($paketLain as $item)
                        <div class="group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
                            
                            @if($item->foto)
                            <div class="relative h-64">
                                <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama_paket }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                <!-- Overlay saat hover -->
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center p-4">
                                    <h3 class="text-white text-lg font-bold mb-1">{{ $item->nama_paket }}</h3>
                                    <p class="text-gray-200 text-sm mb-2">{{ $item->destinasi->nama }} - {{ $item->durasi_hari }} Hari</p>
                                    <span class="block text-sm text-gray-600">
                                        Weekday: Rp {{ number_format($item->harga_weekday,0,',','.') }}
                                    </span>
                                    <span class="block text-sm text-gray-600">
                                        Weekend: Rp {{ number_format($item->harga_weekend,0,',','.') }}
                                    </span>


                                    <a href="{{ route('paket.show', $item->id) }}"
                                    class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold px-4 py-2 rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-transform duration-300">
                                    Lihat Detail
                                    </a>
                                </div>

                                <!-- Badge durasi -->
                                <span class="absolute top-4 left-4 bg-black/60 text-white text-sm font-semibold px-3 py-1 rounded-full shadow-lg">
                                    {{ $item->durasi_hari }} Hari
                                </span>
                            </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-400 text-center col-span-full">Belum ada paket lain tersedia.</p>
                    @endforelse
                </div>
            </div>
        </section>
        </div>
    </div>
</div>
</section>
@endsection
