@extends('layouts.app')

@section('content')

<div class="p-6 max-w-6xl">

    <!-- HEADER -->
    <div class="mb-6 flex items-center gap-2">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Transaksi</h2>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow p-6">

        <form action="{{ route('admin.transaksi.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- LEFT -->
                <div class="space-y-5">

                    <!-- Nama -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                               required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Email</label>
                        <input type="email" name="email"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Telepon</label>
                        <input type="text" name="telepon"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <!-- Paket -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Paket Wisata</label>
                        <select name="paket_id"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

                            @foreach($paketwisata as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="space-y-5">

                    <!-- Jumlah -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Jumlah Orang</label>
                        <input type="number" name="jumlah_orang" value="1" min="1"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Tanggal Berangkat</label>
                        <input type="date" name="tanggal_berangkat"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                               required>
                    </div>

                    <!-- Total -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Total Harga</label>
                        <input type="number" name="total_harga"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                               required>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Status</label>
                        <select name="status"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

                            <option value="pending">Pending</option>
                            <option value="lunas">Lunas</option>
                            <option value="batal">Batal</option>

                        </select>
                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3 pt-4 border-t">

                <a href="{{ route('admin.transaksi.index') }}"
                   class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    Batal
                </a>

                <button type="submit"
                        class="flex items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow transition">

                    <!-- HEROICON SAVE -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>

                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection