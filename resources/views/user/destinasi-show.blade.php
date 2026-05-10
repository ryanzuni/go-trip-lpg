@extends('layouts.user-app')

@section('title', $destinasi->nama . ' - GoTrip Lampung')

@section('banner')
<div class="relative w-screen left-1/2 -translate-x-1/2 h-[510px] -mt-[15px]">
    <img src="{{ asset('storage/'.$destinasi->foto) }}"
        alt="{{ $destinasi->nama }}"
        class="absolute inset-0 w-full h-full object-cover brightness-90">
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-blue-900/40 to-transparent"></div>

    <!-- Text -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6 animate-fade-in">
        <h1 class="text-5xl md:text-6xl font-bold drop-shadow-lg mb-2">{{ $destinasi->nama }}</h1>
        <p class="mt-4 text-xl opacity-90 flex items-center justify-center gap-2">
            <i class="fas fa-map-marker-alt text-red-400"></i> {{ $destinasi->lokasi }}
        </p>
        <div class="mt-4 flex items-center gap-4 text-sm">
            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full flex items-center gap-1">
                <i class="fas fa-eye"></i> {{ $destinasi->views }} dilihat
            </span>
            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full flex items-center gap-1">
                <i class="fas fa-calendar"></i> {{ $destinasi->created_at->format('M Y') }}
            </span>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Detail Konten -->
<section class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <!-- Informasi -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                <i class="fas fa-info-circle text-blue-600"></i> Tentang Destinasi
            </h2>
            <p class="text-gray-600 leading-relaxed text-lg">
                {{ $destinasi->deskripsi ?? 'Belum ada deskripsi untuk destinasi ini.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-lg rounded-3xl p-8 text-center hover:shadow-xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                </div>
                <p class="font-bold text-lg text-gray-800">{{ $destinasi->lokasi }}</p>
                <p class="text-gray-500 text-sm mt-1">Lokasi Strategis</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4">
            <!-- <a href="{{ route('paket.index') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                <i class="fas fa-suitcase"></i> Lihat Paket Wisata
            </a> -->
            <button onclick="shareDestination()"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                <i class="fas fa-share"></i> Bagikan
            </button>
            <button onclick="addToWishlist()"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-pink-400 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                <i class="fas fa-heart"></i> Simpan
            </button>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <div class="bg-white shadow-xl rounded-3xl p-6">
            <h3 class="font-bold text-xl mb-6 flex items-center gap-2">
                <i class="fas fa-star text-yellow-400"></i> Informasi Lengkap
            </h3>
            <ul class="space-y-4 text-gray-600">
                <li class="flex items-center gap-3">
                    <i class="fas fa-clock text-blue-500"></i>
                    <span>Buka setiap hari 08:00 - 17:00</span>
                </li>
                <li class="flex items-center gap-3">
                    <i class="fas fa-car text-green-500"></i>
                    <span>Akses transportasi mudah</span>
                </li>
                <li class="flex items-center gap-3">
                    <i class="fas fa-users text-purple-500"></i>
                    <span>Cocok untuk semua usia</span>
                </li>
                <li class="flex items-center gap-3">
                    <i class="fas fa-camera text-pink-500"></i>
                    <span>Spot foto instagramable</span>
                </li>
            </ul>
        </div>

        <div class="bg-gradient-to-br from-blue-600 to-cyan-400 text-white rounded-3xl p-6 text-center">

            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur">
                <i class="fas fa-suitcase text-2xl"></i>
            </div>

            <h4 class="font-bold text-2xl mb-2">
                Jelajahi Paket Wisata
            </h4>

            <p class="text-blue-100 text-sm leading-relaxed mb-5">
                Temukan berbagai pilihan paket wisata menarik yang mencakup destinasi ini dengan fasilitas lengkap dan harga terbaik.
            </p>

            <a href="{{ route('paket.index') }}"
                class="inline-flex items-center gap-2 bg-white text-blue-600 font-semibold px-6 py-3 rounded-xl hover:bg-blue-50 hover:scale-105 transition duration-300 shadow-lg">

                <i class="fas fa-arrow-right"></i>
                Lihat Paket Wisata
            </a>

        </div>

        <a href="{{ route('destinasi.index') }}"
            class="block text-center bg-gradient-to-r from-gray-600 to-gray-700 text-white py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
            ← Kembali ke Daftar Destinasi
        </a>
    </div>
</section>

<!-- Rekomendasi Lain -->
@if($related && $related->count() > 0)
<section class="bg-gradient-to-br from-blue-50 via-white to-cyan-50 py-16">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-blue-600 text-center mb-12 flex items-center justify-center gap-3">
            <i class="fas fa-compass text-blue-600"></i> Rekomendasi Destinasi Lain
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($related as $item)
            <a href="{{ route('destinasi.show', $item->id) }}"
                class="group relative rounded-3xl overflow-hidden shadow-xl cursor-pointer transform transition-all duration-500 hover:scale-105 hover:shadow-2xl">

                <!-- Gambar -->
                <div class="relative h-64">
                    <img src="{{ asset('storage/'.$item->foto) }}"
                        alt="{{ $item->nama }}"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 group-hover:brightness-90">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-6 transition-all duration-500 group-hover:from-black/80 group-hover:via-black/50">
                        <h3 class="text-lg font-bold text-white mb-1">{{ $item->nama }}</h3>
                        <p class="text-sm text-gray-200 mb-2 flex items-center gap-1">
                            <i class="fas fa-map-marker-alt text-red-400"></i> {{ $item->lokasi }}
                        </p>
                        <p class="text-yellow-300 font-semibold text-sm flex items-center gap-1">
                            <i class="fas fa-map-marked-alt"></i>
                            Destinasi Wisata
                        </p>
                    </div>

                    <!-- Views Badge -->
                    <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-eye mr-1"></i> {{ $item->views ?? 0 }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
    function shareDestination() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $destinasi->nama }}',
                text: 'Temukan destinasi wisata menarik: {{ $destinasi->nama }}',
                url: window.location.href
            });
        } else {
            // Fallback untuk browser yang tidak mendukung Web Share API
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Link berhasil disalin ke clipboard!');
            });
        }
    }

    function addToWishlist() {
        // Implementasi wishlist bisa ditambahkan nanti
        alert('Destinasi ditambahkan ke wishlist! ❤️');
    }

    // Animasi fade-in
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('.animate-fade-in');
        elements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.2}s`;
        });
    });
</script>

<style>
    @keyframes fade-in {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.8s ease-out forwards;
        opacity: 0;
    }
</style>
@endsection