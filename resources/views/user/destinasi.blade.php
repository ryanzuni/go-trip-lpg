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
{{-- Destinasi Wisata --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12 max-w-6xl mx-auto">
    @foreach($destinasi as $item)
        <a href="{{ route('destinasi.show', $item->id) }}"
           class="relative h-72 rounded-2xl overflow-hidden shadow-lg transform transition hover:scale-105 hover:shadow-2xl">
           
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
        </a>
    @endforeach
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
