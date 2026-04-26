@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Transaksi</h2>

        <a href="{{ route('admin.transaksi.create') }}"
           class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">

            <!-- HEROICON PLUS -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"/>
            </svg>

            Tambah
        </a>
    </div>

    <!-- FLASH -->
    @if(session('success'))
    <div class="mb-4 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">

        <!-- CHECK ICON -->
        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2"
                d="M5 13l4 4L19 7"/>
        </svg>

        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- HEAD -->
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Pelanggan</th>
                        <th class="px-6 py-4 text-left">Paket</th>
                        <th class="px-6 py-4 text-center">Jumlah</th>
                        <th class="px-6 py-4 text-center">Tanggal</th>
                        <th class="px-6 py-4 text-right">Total</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                @forelse ($transaksis as $i => $transaksi)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 text-gray-500">
                        {{ $i + 1 }}
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $transaksi->nama_pelanggan }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $transaksi->paketWisata->nama_paket ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ $transaksi->jumlah_orang }}
                    </td>

                    <td class="px-6 py-4 text-center text-gray-500">
                        {{ \Carbon\Carbon::parse($transaksi->tanggal_berangkat)->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4 text-right font-semibold text-gray-800">
                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4 text-center">
                        @if($transaksi->status === 'success')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                Success
                            </span>
                        @elseif($transaksi->status === 'pending')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600">
                                Pending
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-600">
                                Cancel
                            </span>
                        @endif
                    </td>

                    <!-- ACTION -->
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">

                            <!-- EDIT -->
                            <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}"
                               class="p-2 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5h2M12 7v10m7-7H5"/>
                                </svg>

                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus transaksi ini?')"
                                        class="p-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-1 12H6L5 7m5-3h4m-6 3h8"/>
                                    </svg>

                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="8" class="text-center py-12 text-gray-400">
                        Belum ada transaksi
                    </td>
                </tr>
                @endforelse

                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection