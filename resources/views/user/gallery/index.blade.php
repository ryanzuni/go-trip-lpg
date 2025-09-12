@extends('layouts.user-app')

@section('title', 'Gallery Wisata')

@section('banner')
<div class="relative w-screen left-1/2 -translate-x-1/2 h-[570px] -mt-[15px]">
    <img src="{{ asset('images/banner-gallery.jpeg') }}" 
         alt="Gallery Wisata" 
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-lg mb-3">
            Gallery Wisata
        </h1>
        <p class="text-lg md:text-xl opacity-90">
            Dokumentasi perjalanan & destinasi pilihan
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
                Koleksi Galeri
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto animate-fade-in delay-200">
                Temukan dokumentasi perjalanan wisata yang menginspirasi untuk liburanmu berikutnya.
            </p>
        </div>

        <!-- Grid Gallery -->
        @if($galleries->count() == 0)
            <p class="text-gray-400 text-center text-lg">Belum ada galeri tersedia.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($galleries as $gallery)
            <div class="group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500 animate-fade-card">

                <!-- Gambar Sampul -->
                <div class="relative h-72">
                    @if($gallery->image)
                    <img src="{{ asset('storage/'.$gallery->image) }}" 
                         alt="{{ $gallery->title }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @endif

                    <!-- Overlay saat hover -->
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center p-4">
                        <h3 class="text-white text-2xl font-bold mb-2">{{ $gallery->title }}</h3>
                        <p class="text-gray-200 text-sm mb-3">{{ Str::limit($gallery->description, 60) }}</p>

                        <a href="{{ route('user.gallery.show', $gallery->id) }}"
                           class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold px-5 py-2 rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-transform duration-300">
                           Lihat Galeri
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $galleries->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
