@extends('layouts.user-app')

@section('title', 'Paket Wisata')

@section('banner')
<div class="relative w-screen left-1/2 -translate-x-1/2 h-[570px] -mt-[15px]">
    <img src="{{ asset('images/banner1.jpeg') }}" 
         alt="Paket Wisata" 
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-lg mb-3">
            Paket Wisata
        </h1>
        <p class="text-lg md:text-xl opacity-90">
            Menawarkan paket trip
        </p>
    </div>
</div>
@endsection

@section('content')
<section class="pt-12 pb-20 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
        <!-- Judul -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-3 animate-fade-in">
                Paket Wisata Premium
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto animate-fade-in delay-200">
                Pilihan paket liburan terbaik untuk kamu dan keluarga. Nikmati pengalaman tak terlupakan.
            </p>
        </div>

        <!-- Grid Paket -->
        @if($paket->count() == 0)
            <p class="text-gray-400 text-center text-lg">Belum ada paket wisata tersedia.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($paket as $item)
            <div class="group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500 animate-fade-card">
                
                <!-- Ribbon “Terlaris” -->
                @if($item->harga > 2000000) <!-- contoh kondisi dinamis -->
                <div class="absolute top-4 right-0 bg-yellow-400 text-gray-900 font-bold px-3 py-1 rounded-l-full shadow-lg z-10 animate-pulse">
                    Terlaris
                </div>
                @endif

                <!-- Gambar -->
                <div class="relative h-72">
                    @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama_paket }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @endif

                    <!-- Overlay saat hover -->
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center p-4">
                        <h3 class="text-white text-2xl font-bold mb-2">{{ $item->nama_paket }}</h3>
                        <p class="text-gray-200 text-sm mb-2">{{ $item->destinasi->nama }} - {{ $item->durasi_hari }} Hari</p>
                        <span class="text-white font-semibold bg-blue-600/80 px-4 py-1 rounded-full shadow-lg mb-3 animate-pulse">
                            Rp {{ number_format($item->harga,0,',','.') }}
                        </span>
                        <!-- Contoh label booking -->
                        <span class="text-sm text-gray-200 bg-black/50 px-2 py-1 rounded-full mb-2">
                            📌 {{ $item->bookings_count }} booking
                        </span>


                        <a href="{{ route('user.paket.show', $item->id) }}"
                           class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold px-5 py-2 rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-transform duration-300">
                           Lihat Detail
                        </a>
                    </div>

                    <!-- Badge durasi -->
                    <span class="absolute top-4 left-4 bg-black/60 text-white text-sm font-semibold px-3 py-1 rounded-full shadow-lg animate-bounce">
                        {{ $item->durasi_hari }} Hari
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        <!-- CTA tambahan -->
        <!-- <div class="mt-12 text-center">
            <p class="text-gray-700 text-lg font-medium animate-fade-in delay-400">
                Temukan paket liburan favoritmu sekarang dan buat momen tak terlupakan bersama keluarga!
            </p>
            <a href="{{ route('user.paket.index') }}"
               class="mt-4 inline-block bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:scale-105 transition-transform duration-300 animate-fade-in delay-600">
                Jelajahi Semua Paket
            </a>
        </div> -->

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $paket->links() }}
        </div>
        @endif
    </div>
</section>

<style>
/* Animasi fade-in */
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
.animate-fade-in { animation: fadeIn 0.8s ease forwards; }
.animate-fade-in.delay-200 { animation-delay: 0.2s; }
.animate-fade-in.delay-400 { animation-delay: 0.4s; }
.animate-fade-in.delay-600 { animation-delay: 0.6s; }

/* Animasi kartu */
@keyframes fadeCard { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.animate-fade-card { animation: fadeCard 0.6s ease forwards; }

/* Pulse & bounce */
.animate-pulse { animation: pulse 2s infinite; }
@keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:0.7;} }
.animate-bounce { animation: bounce 2s infinite; }
@keyframes bounce { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-5px);} }
</style>
@endsection
