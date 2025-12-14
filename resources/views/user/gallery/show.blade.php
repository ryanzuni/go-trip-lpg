@extends('layouts.user-app')

@section('title', $gallery->title)

{{-- Hero Section --}}
@section('banner')
<div class="relative w-screen left-1/2 -translate-x-1/2 h-[70vh] -mt-[15px] overflow-hidden">
    <!-- Background Image -->
    @if($gallery->image)
    <img src="{{ asset('storage/'.$gallery->image) }}"
         alt="{{ $gallery->title }}"
         class="w-full h-full object-cover">
    @else
    <div class="w-full h-full bg-gradient-to-br from-blue-900 via-cyan-800 to-teal-900"></div>
    @endif

    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

    <!-- Content -->
    <div class="absolute inset-0 flex items-end">
        <div class="w-full max-w-7xl mx-auto px-6 pb-16">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm text-white text-sm font-medium rounded-full">
                        Galeri Wisata
                    </span>
                    <span class="text-white/80 text-sm">
                        {{ $gallery->created_at->format('d M Y') }}
                    </span>
                </div>

                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                    {{ $gallery->title }}
                </h1>

                <p class="text-xl text-white/90 leading-relaxed mb-8">
                    {{ Str::limit($gallery->description, 200) }}
                </p>

                <!-- Stats -->
                <div class="flex flex-wrap gap-6">
                    <div class="flex items-center gap-2 text-white/80">
                        <i class="fas fa-camera text-cyan-300"></i>
                        <span>{{ $gallery->image ? '1' : '0' }} Foto</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/80">
                        <i class="fas fa-eye text-cyan-300"></i>
                        <span>Dilihat {{ $gallery->views }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="py-20 px-6 bg-gray-50">
    <div class="max-w-7xl mx-auto">

        <!-- Gallery Image -->
        @if($gallery->image)
        <div class="mb-16">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <img src="{{ asset('storage/'.$gallery->image) }}"
                     alt="{{ $gallery->title }}"
                     class="w-full h-auto max-h-[600px] object-cover">

                <!-- Image Info Overlay -->
                <div class="p-8 bg-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $gallery->title }}</h3>
                            <p class="text-gray-600">{{ $gallery->description }}</p>
                        </div>

                        <div class="flex gap-4">
                            <button class="p-3 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors duration-300">
                                <i class="fas fa-heart text-gray-600"></i>
                            </button>
                            <button class="p-3 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors duration-300">
                                <i class="fas fa-share text-gray-600"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Gallery Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-image text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Judul</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $gallery->title }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Dibuat</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $gallery->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-camera text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Foto</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $gallery->image ? '1' : '0' }} Item</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="bg-white rounded-3xl p-10 shadow-lg mb-16 border border-gray-100">
            <div class="flex items-start gap-6">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info-circle text-white text-2xl"></i>
                </div>

                <div class="flex-1">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Tentang Galeri Ini</h2>
                    <div class="prose prose-lg text-gray-700 max-w-none">
                        <p class="text-lg leading-relaxed">
                            {{ $gallery->description ?? 'Galeri ini menampilkan dokumentasi perjalanan wisata yang menakjubkan. Setiap foto menceritakan kisah petualangan dan keindahan destinasi yang dikunjungi.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex justify-center">
            <a href="{{ route('gallery.index') }}"
               class="group inline-flex items-center gap-4 px-8 py-4 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-blue-200">
               <i class="fas fa-arrow-left text-gray-600 group-hover:text-blue-600 transition-colors duration-300"></i>
               <span class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">
                   Kembali ke Koleksi Galeri
               </span>
               <i class="fas fa-images text-gray-600 group-hover:text-blue-600 transition-colors duration-300"></i>
            </a>
        </div>
    </div>
</section>

<!-- Recommended Galleries Section -->
<section class="py-20 px-6 bg-gradient-to-br from-blue-50 to-cyan-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Rekomendasi Galeri Lainnya
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Jelajahi lebih banyak dokumentasi perjalanan wisata yang menakjubkan
            </p>
        </div>

        @if($galleries->count() > 1)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($galleries->where('id', '!=', $gallery->id)->take(3) as $recommended)
            <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                <!-- Image -->
                <div class="relative h-48 overflow-hidden">
                    @if($recommended->image)
                    <img src="{{ asset('storage/'.$recommended->image) }}"
                         alt="{{ $recommended->title }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <i class="fas fa-image text-3xl text-gray-400"></i>
                    </div>
                    @endif

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <!-- Action Button -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                        <a href="{{ route('gallery.show', $recommended->id) }}"
                           class="bg-white text-gray-900 px-5 py-2 rounded-full font-semibold hover:bg-gray-50 transition-colors duration-300 shadow-lg text-sm">
                           <i class="fas fa-eye mr-2"></i>
                           Lihat
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                        {{ $recommended->title }}
                    </h3>

                    <p class="text-gray-600 text-sm leading-relaxed mb-3 line-clamp-2">
                        {{ Str::limit($recommended->description, 80) }}
                    </p>

                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <div class="flex items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $recommended->created_at->format('M Y') }}</span>
                        </div>

                        <div class="flex items-center gap-1">
                            <i class="fas fa-eye"></i>
                            <span>{{ $recommended->views }} dilihat</span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-images text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Rekomendasi</h3>
            <p class="text-gray-600">
                Tambahkan lebih banyak galeri untuk melihat rekomendasi di sini.
            </p>
        </div>
        @endif

        <!-- View All Button -->
        <div class="text-center mt-12">
            <a href="{{ route('gallery.index') }}"
               class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
               <i class="fas fa-th-large"></i>
               <span>Lihat Semua Galeri</span>
               <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endsection
