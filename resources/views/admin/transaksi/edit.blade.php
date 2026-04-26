@extends('layouts.app')

@section('content')

<div class="p-6 max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6 flex items-center gap-3">
        <!-- Heroicon Pencil -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5h2m-1-1v2m-7 8l8-8 4 4-8 8H5v-4z"/>
        </svg>

        <div>
            <h2 class="text-xl font-semibold text-gray-800">Edit Transaksi</h2>
            <p class="text-sm text-gray-500">Perbarui data transaksi pelanggan</p>
        </div>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-sm p-6">

        <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- GRID -->
            <div class="grid md:grid-cols-2 gap-5">

                <!-- Nama -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan"
                        value="{{ old('nama_pelanggan', $transaksi->nama_pelanggan) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $transaksi->email) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Telepon -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Telepon</label>
                    <input type="text" name="telepon"
                        value="{{ old('telepon', $transaksi->telepon) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Paket -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Paket Wisata</label>
                    <select name="paket_id"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        @foreach($paket as $p)
                            <option value="{{ $p->id }}"
                                {{ old('paket_id', $transaksi->paket_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Jumlah Orang</label>
                    <input type="number" name="jumlah_orang" min="1"
                        value="{{ old('jumlah_orang', $transaksi->jumlah_orang) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat"
                        value="{{ old('tanggal_berangkat', $transaksi->tanggal_berangkat ? \Carbon\Carbon::parse($transaksi->tanggal_berangkat)->format('Y-m-d') : '') }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Total -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Total Harga</label>
                    <input type="number" name="total_harga"
                        value="{{ old('total_harga', $transaksi->total_harga) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Status -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

                        <option value="pending" {{ $transaksi->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="lunas" {{ $transaksi->status=='lunas'?'selected':'' }}>Lunas</option>
                        <option value="batal" {{ $transaksi->status=='batal'?'selected':'' }}>Batal</option>

                    </select>
                </div>

            </div>

            <!-- ACTION -->
            <div class="flex justify-end gap-3 pt-4">

                <!-- BACK -->
                <a href="{{ route('admin.transaksi.index') }}"
                   class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition flex items-center gap-2">

                    <!-- Arrow Left Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7"/>
                    </svg>

                    Batal
                </a>

                <!-- SUBMIT -->
                <button type="submit"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow flex items-center gap-2">

                    <!-- Save Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                    </svg>

                    Update
                </button>

            </div>

        </form>
    </div>

</div>

@endsection