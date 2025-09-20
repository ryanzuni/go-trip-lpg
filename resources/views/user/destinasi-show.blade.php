@extends('layouts.user-app')

@section('title', $destinasi->nama . ' - Pariwisata Kita')

@section('content')
<!-- Banner Full Width (benar-benar nempel kiri kanan layar) -->
<section class="relative h-[80vh] flex items-center justify-center bg-cover bg-center">
    <img src="{{ asset('storage/'.$destinasi->foto) }}" 
         alt="{{ $destinasi->nama }}" 
         class="absolute inset-0 w-full h-full object-cover">
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
    
    <!-- Text -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6">
        <h1 class="text-5xl md:text-6xl font-bold drop-shadow-lg">{{ $destinasi->nama }}</h1>
        <p class="mt-4 text-xl opacity-90">
            <i class="fas fa-map-marker-alt text-red-400"></i> {{ $destinasi->lokasi }}
        </p>
    </div>
</section>


<!-- Detail Konten -->
<section class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-10">
    <!-- Informasi -->
    <div class="md:col-span-2 space-y-6">
        <h2 class="text-2xl font-bold text-gray-800">Tentang Destinasi</h2>
        <p class="text-gray-600 leading-relaxed">
            {{ $destinasi->deskripsi ?? 'Belum ada deskripsi untuk destinasi ini.' }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
            <div class="bg-white shadow rounded-2xl p-6 text-center hover:shadow-lg transition">
                <i class="fas fa-map-marker-alt text-blue-600 text-3xl mb-3"></i>
                <p class="font-semibold">{{ $destinasi->lokasi }}</p>
                <p class="text-gray-500 text-sm">Lokasi</p>
            </div>
            <div class="bg-white shadow rounded-2xl p-6 text-center hover:shadow-lg transition">
                <i class="fas fa-ticket-alt text-green-600 text-3xl mb-3"></i>
                <p class="font-semibold">
                    {{ $destinasi->harga_tiket ? 'Rp ' . number_format($destinasi->harga_tiket,0,',','.') : 'Gratis' }}
                </p>
                <p class="text-gray-500 text-sm">Harga Tiket</p>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <div class="bg-white shadow rounded-2xl p-6">
            <h3 class="font-bold text-lg mb-4">Informasi Singkat</h3>
            <ul class="space-y-3 text-gray-600">
                <li><i class="fas fa-clock text-blue-500 mr-2"></i> Buka setiap hari</li>
                <li><i class="fas fa-car text-green-500 mr-2"></i> Akses transportasi mudah</li>
                <li><i class="fas fa-star text-yellow-400 mr-2"></i> Destinasi populer</li>
            </ul>
        </div>

        <a href="{{ route('destinasi.index') }}" 
           class="block text-center bg-blue-600 text-white py-3 rounded-xl font-semibold shadow hover:bg-blue-700 transition">
            ← Kembali ke Daftar Destinasi
        </a>
    </div>
</section>

<!-- Rekomendasi Lain -->
@if($related = \App\Models\Destinasi::where('id','!=',$destinasi->id)->inRandomOrder()->take(3)->get())
<section class="bg-gray-50 py-16">
    <h2 class="text-2xl font-bold text-blue-600 text-center mb-10">Rekomendasi Destinasi Lain</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto px-6">
        @foreach($related as $item)
        <a href="{{ route('destinasi.show', $item->id) }}" 
            class="group relative rounded-2xl overflow-hidden shadow-lg cursor-pointer transform transition duration-500 hover:scale-[1.05] hover:shadow-2xl">
                
                <!-- Gambar -->
                <img src="{{ asset('storage/'.$item->foto) }}" 
                    alt="{{ $item->nama }}" 
                    class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110 group-hover:brightness-90">
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-5 transition-all duration-500 group-hover:from-black/80 group-hover:via-black/50">
                    <h3 class="text-lg font-bold text-white">{{ $item->nama }}</h3>
                    <p class="text-sm text-gray-200">{{ $item->lokasi }}</p>
                    <p class="text-yellow-300 font-semibold mt-1 text-sm">
                        {{ $item->harga_tiket ? 'Rp ' . number_format($item->harga_tiket,0,',','.') : 'Gratis' }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection
