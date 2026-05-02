@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Paket Wisata</h2>
            <p class="text-gray-500 text-sm">Kelola paket wisata yang tersedia</p>
        </div>

        <a href="{{ route('admin.paket_wisata.create') }}"
           class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">

            <!-- HEROICON PLUS -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>

            Tambah
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">

                <!-- HEADER -->
                <thead class="bg-gray-50 text-gray-600 text-left">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Nama Paket</th>
                        <th class="px-6 py-3">Destinasi</th>
                        <th class="px-6 py-3">Durasi</th>
                        <th class="px-6 py-3">Weekday</th>
                        <th class="px-6 py-3">Weekend</th>
                        <th class="px-6 py-3">Foto</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y">

                    @forelse($paket as $item)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $item->nama_paket }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->destinasi ? $item->destinasi->pluck('nama')->join(', ') : '-' }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->durasi_hari }} Hari
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            Rp {{ number_format($item->harga_weekday,0,',','.') }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            Rp {{ number_format($item->harga_weekend,0,',','.') }}
                        </td>

                        <td class="px-6 py-4">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}"
                                     class="w-16 h-12 object-cover rounded-lg shadow">
                            @else
                                <span class="text-gray-400 text-xs">No Image</span>
                            @endif
                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('admin.paket_wisata.edit',$item->id) }}"
                                   class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200">

                                    <!-- HEROICON PENCIL -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z" />
                                    </svg>
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.paket_wisata.destroy',$item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus paket ini?')">
                                    @csrf @method('DELETE')

                                    <button type="submit"
                                        class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">

                                        <!-- HEROICON TRASH -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 7h12M9 7V4h6v3m-8 4v6m4-6v6m4-6v6" />
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty
                    <!-- EMPTY STATE -->
                    <tr>
                        <td colspan="8" class="text-center py-12">

                            <div class="flex flex-col items-center justify-center gap-3">

                                <!-- HEROICON BOX -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-10 h-10 text-gray-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M20 13V7a2 2 0 00-1-1.732l-6-3.5a2 2 0 00-2 0l-6 3.5A2 2 0 004 7v6m16 0l-8 4-8-4" />
                                </svg>

                                <p class="text-gray-500">Belum ada paket wisata</p>

                                <a href="{{ route('admin.paket_wisata.create') }}"
                                   class="text-blue-600 text-sm hover:underline">
                                   Tambah sekarang
                                </a>

                            </div>

                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="p-4">
            {{ $paket->links() }}
        </div>

    </div>

</div>

@endsection