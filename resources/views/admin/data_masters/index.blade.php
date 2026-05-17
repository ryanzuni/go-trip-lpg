@extends('layouts.app')

@section('title', 'Data Master')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Data Master Transaksi</h2>
    </div>

    <!-- FILTER -->
    <form method="GET" class="bg-white p-4 rounded-2xl shadow mb-6">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <!-- STATUS -->
            <select name="status"
                class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

                <option value="all">Semua Status</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                <option value="lunas" {{ request('status')=='lunas'?'selected':'' }}>Lunas</option>
                <option value="batal" {{ request('status')=='batal'?'selected':'' }}>Batal</option>

            </select>

            <!-- START -->
            <input type="date" name="start_date"
                value="{{ request('start_date') }}"
                class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

            <!-- END -->
            <input type="date" name="end_date"
                value="{{ request('end_date') }}"
                class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

            <!-- BUTTON -->
            <button type="submit"
                class="flex items-center justify-center gap-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">

                <!-- HEROICON FILTER -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 7v5l-4-2v-3L3 6V4z"/>
                </svg>

                Filter
            </button>

        </div>

    </form>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- HEAD -->
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Pelanggan</th>
                        <th class="px-6 py-4 text-left">Paket</th>
                        <th class="px-6 py-4 text-center">Jumlah</th>
                        <th class="px-6 py-4 text-center">Tanggal</th>
                        <th class="px-6 py-4 text-right">Total</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                @forelse ($dataMasters as $key => $item)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 text-gray-500">
                        {{ $dataMasters->firstItem() + $key }}
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $item->nama_pelanggan }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->paketWisata->nama_paket ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ $item->jumlah_orang }}
                    </td>

                    <td class="px-6 py-4 text-center text-gray-500">
                        {{ \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4 text-right font-semibold text-gray-800">
                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4 text-center">
                        @if($item->status == 'lunas')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                Lunas
                            </span>
                        @elseif($item->status == 'pending')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600">
                                Pending
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-600">
                                Batal
                            </span>
                        @endif
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center py-12 text-gray-400">
                        Belum ada data master
                    </td>
                </tr>
                @endforelse

                </tbody>
            </table>
        </div>

    </div>

    <!-- PAGINATION -->
    <div class="mt-6 flex justify-end">
        {{ $dataMasters->links() }}
    </div>

</div>

@endsection