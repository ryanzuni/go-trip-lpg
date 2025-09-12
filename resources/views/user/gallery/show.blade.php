@extends('layouts.user-app')

@section('title', $gallery->title)

{{-- Banner Full Width --}}
@section('banner')
<div class="relative w-screen left-1/2 -translate-x-1/2 h-[420px] -mt-[15px]">
    <img src="{{ asset('storage/'.$gallery->image) }}" 
         alt="{{ $gallery->title }}" 
         class="w-full h-full object-cover brightness-90">
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-lg mb-3">
            {{ $gallery->title }}
        </h1>
        <p class="text-lg opacity-90">Dokumentasi Kegiatan & Momen Wisata</p>
    </div>
</div>
@endsection

@section('content')
<section class="pt-16 pb-20 px-6 bg-gray-50">
    <div class="max-w-6xl mx-auto">

        <!-- Info Galeri -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="flex items-center gap-4 bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
                <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-xl">
                    <i class="bi bi-image text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Judul Galeri</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $gallery->title }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
                <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-xl">
                    <i class="bi bi-calendar-event text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Tanggal Dibuat</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $gallery->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
                <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-xl">
                    <i class="bi bi-collection text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Jumlah Foto</p>
                    <p class="text-lg font-bold text-blue-600">{{ $gallery->image ? 1 : 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Foto Utama -->
        <div class="mb-14">
            <div class="group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition">
                <img src="{{ asset('storage/'.$gallery->image) }}" 
                     alt="{{ $gallery->title }}" 
                     class="w-full h-[500px] object-cover rounded-3xl transform group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <span class="text-white text-lg font-medium">Klik untuk memperbesar</span>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-14">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="bi bi-info-circle text-blue-600"></i> Deskripsi
            </h2>
            <p class="text-gray-700 leading-relaxed text-lg">
                {{ $gallery->description ?? 'Belum ada deskripsi.' }}
            </p>
        </div>

        <!-- Tombol Back -->
        <div class="flex justify-center">
            <a href="{{ route('user.gallery.index') }}" 
               class="px-8 py-3 rounded-full bg-gradient-to-r from-blue-600 to-cyan-400 text-white font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition">
               ← Kembali ke Galeri
            </a>
        </div>
    </div>
</section>
@endsection
