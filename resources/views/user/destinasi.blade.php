@extends('layouts.user-app')

@section('title', 'Destinasi Wisata & Info Menarik')

@section('banner')
<div class="relative w-screen left-1/2 -translate-x-1/2 h-[570px] -mt-[15px]">
    <img src="{{ asset('images/banner2.jpeg') }}"
         alt="Destinasi Wisata"
         class="w-full h-full object-cover brightness-90">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-900/60 via-blue-700/50 to-cyan-600/60"></div>

    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-lg mb-3 animate-fade-in">
            Destinasi Wisata Terbaik
        </h1>
        <p class="text-lg md:text-xl opacity-90 animate-fade-in delay-200">
            Jelajahi destinasi wisata menarik bersama kami
        </p>
    </div>
</div>
@endsection

@section('content')
<section class="pt-12 pb-20 px-6 bg-gradient-to-br from-blue-50 via-white to-cyan-50">
    <div class="max-w-7xl mx-auto">
        <!-- Judul -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-3 animate-fade-in">
                Koleksi Destinasi
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto animate-fade-in delay-200">
                Temukan destinasi wisata impian untuk petualangan tak terlupakan.
            </p>
        </div>

        <!-- Grid Destinasi -->
        @if($destinasi->count() == 0)
            <p class="text-gray-400 text-center text-lg">Belum ada destinasi tersedia.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($destinasi as $index => $item)
            <a href="{{ route('destinasi.show', $item->id) }}"
               class="group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500 animate-fade-card"
               style="animation-delay: {{ $index * 0.1 }}s">

                <!-- Gambar -->
                <div class="relative h-80">
                    @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}"
                         alt="{{ $item->nama }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @endif

                    <!-- Overlay saat hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                        <h3 class="text-white text-2xl font-bold mb-2">{{ $item->nama }}</h3>
                        <p class="text-gray-200 text-sm mb-2 flex items-center gap-1">
                            <i class="fas fa-map-marker-alt text-red-400"></i> {{ $item->lokasi }}
                        </p>
                        <p class="text-yellow-300 font-semibold mb-3 flex items-center gap-1">
                            <i class="fas fa-map-marked-alt"></i>
                            Destinasi Wisata
                        </p>

                        <div class="flex items-center justify-between">
                            <span class="inline-block bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i> {{ $item->views ?? 0 }} dilihat
                            </span>
                            <span class="inline-block bg-gradient-to-r from-blue-600 to-cyan-400 text-white font-semibold px-4 py-2 rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
                                Jelajahi
                            </span>
                        </div>
                    </div>

                    <!-- Badge Popular -->
                    @if(($item->views ?? 0) > 10)
                    <div class="absolute top-4 right-4 bg-gradient-to-r from-orange-400 to-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                        <i class="fas fa-fire mr-1"></i> POPULAR
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $destinasi->links() }}
        </div>
        @endif
    </div>
</section>

<style>
@keyframes fade-in {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes fade-card {
    0% { opacity: 0; transform: translateY(30px) scale(0.95); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}

.animate-fade-in {
    animation: fade-in 0.8s ease-out forwards;
}

.animate-fade-card {
    animation: fade-card 0.6s ease-out forwards;
    opacity: 0;
}

.delay-200 {
    animation-delay: 0.2s;
}
</style>
@endsection
