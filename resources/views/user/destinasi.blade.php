@extends('layouts.user-app')

@section('title', 'Destinasi Wisata & Info Menarik')

@section('banner')
<div class="relative w-screen left-1/2 -translate-x-1/2 h-[570px] -mt-[15px]">
    <img src="{{ asset('images/banner2.jpeg') }}" 
         alt="Destinasi Wisata" 
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-lg mb-3">
            Destinasi Wisata Terbaik
        </h1>
        <p class="text-lg md:text-xl opacity-90">
            Jelajahi destinasi wisata menarik bersama kami
        </p>
    </div>
</div>
@endsection

@section('content')
{{-- Destinasi Wisata dari Database --}}
<h2 class="text-3xl font-bold text-blue-600 mb-8 text-center">Destinasi Wisata</h2>

@if($destinasi->count() == 0)
    <p class="text-gray-400 text-center">Belum ada data destinasi wisata.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12 max-w-6xl mx-auto">
        @foreach($destinasi as $item)
            <div class="relative h-72 rounded-2xl overflow-hidden shadow-lg cursor-pointer transform transition hover:scale-105 hover:shadow-2xl"
                 onclick="openModal('modal-{{ $item->id }}')">
                 
                @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" 
                         alt="{{ $item->nama }}" 
                         class="absolute inset-0 w-full h-full object-cover">
                @endif

                <div class="absolute inset-0 bg-black/40 flex flex-col justify-end p-4">
                    <h3 class="text-lg font-bold text-white">{{ $item->nama }}</h3>
                    <p class="text-sm text-gray-200">{{ $item->lokasi }}</p>
                    <p class="text-yellow-300 font-semibold mt-1">
                        {{ $item->harga_tiket ? 'Rp ' . number_format($item->harga_tiket,0,',','.') : 'Gratis' }}
                    </p>
                </div>
            </div>

            {{-- Modal --}}
            <div id="modal-{{ $item->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <div class="bg-white rounded-3xl w-11/12 md:w-2/3 lg:w-1/2 p-6 relative">
                    <button onclick="closeModal('modal-{{ $item->id }}')" 
                            class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>

                    @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}" 
                             alt="{{ $item->nama }}" 
                             class="w-full h-64 object-cover rounded-2xl mb-4">
                    @endif

                    <h3 class="text-2xl font-bold text-blue-600 mb-2">{{ $item->nama }}</h3>
                    <p class="text-gray-600 mb-2">{{ $item->lokasi }}</p>
                    <p class="text-gray-700 mb-3">{{ $item->deskripsi ?? 'Deskripsi tidak tersedia.' }}</p>
                    <p class="text-blue-600 font-bold text-lg">
                        {{ $item->harga_tiket ? 'Rp ' . number_format($item->harga_tiket,0,',','.') : 'Gratis' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 flex justify-center">
        {{ $destinasi->links() }}
    </div>
@endif

{{-- Pemberitahuan Modern --}}
<h2 class="text-3xl font-bold text-blue-600 mb-8 text-center">Pemberitahuan</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto mb-12">
    <div class="bg-yellow-100 p-6 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
        <span class="badge bg-yellow-600 text-white mb-2">Maintenance</span>
        <h3 class="text-xl font-bold mb-2">Sistem Maintenance</h3>
        <p>Sistem akan maintenance pada Sabtu, 7 September 2025 pukul 02.00-04.00 WIB. Mohon simpan pekerjaan Anda sebelumnya.</p>
    </div>

    <div class="bg-blue-100 p-6 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
        <span class="badge bg-blue-700 text-white mb-2">Promo</span>
        <h3 class="text-xl font-bold mb-2">Diskon Tiket</h3>
        <p>Dapatkan diskon 20% untuk destinasi wisata X sampai akhir bulan ini. Buruan pesan tiketnya!</p>
    </div>

    <div class="bg-red-100 p-6 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
        <span class="badge bg-red-700 text-white mb-2">Peringatan</span>
        <h3 class="text-xl font-bold mb-2">Peringatan Cuaca</h3>
        <p>Cuaca ekstrem diperkirakan di wilayah Y pada hari Minggu. Harap berhati-hati saat berkunjung dan cek info terbaru.</p>
    </div>
</div>

{{-- Tips & Info Menarik --}}
<h2 class="text-3xl font-bold text-blue-600 mb-8 text-center">Tips & Info Menarik</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto mb-12">
    <div class="bg-green-100 p-6 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
        <h3 class="text-xl font-bold mb-2">Jangan Lupa Kamera!</h3>
        <p>Abadikan momen liburanmu di destinasi favorit.</p>
    </div>

    <div class="bg-purple-100 p-6 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
        <h3 class="text-xl font-bold mb-2">Cek Cuaca Terlebih Dahulu</h3>
        <p>Persiapkan pakaian dan perlengkapan sesuai kondisi cuaca.</p>
    </div>

    <div class="bg-pink-100 p-6 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
        <h3 class="text-xl font-bold mb-2">Rencanakan Itinerary</h3>
        <p>Buat rencana perjalanan agar liburan lebih menyenangkan dan hemat waktu.</p>
    </div>
</div>

{{-- Grid Baru: Destinasi Populer --}}
<h2 class="text-3xl font-bold text-blue-600 mb-8 text-center">Destinasi Populer</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto mb-12">
    <div class="bg-gradient-to-br from-yellow-400 to-orange-400 text-white p-6 rounded-3xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition">
        <h3 class="text-xl font-bold mb-2">Pantai Sunset</h3>
        <p>Nikmati pemandangan matahari terbenam yang memukau.</p>
    </div>

    <div class="bg-gradient-to-br from-blue-400 to-indigo-500 text-white p-6 rounded-3xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition">
        <h3 class="text-xl font-bold mb-2">Gunung Seruni</h3>
        <p>Rasakan petualangan seru mendaki puncak Gunung Seruni.</p>
    </div>

    <div class="bg-gradient-to-br from-green-400 to-teal-500 text-white p-6 rounded-3xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition">
        <h3 class="text-xl font-bold mb-2">Danau Crystal</h3>
        <p>Air danau jernih seperti kristal, sempurna untuk foto.</p>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
</script>

<style>
.badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
}
</style>
@endsection
