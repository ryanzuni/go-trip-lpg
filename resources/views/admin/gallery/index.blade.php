@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">

                <!-- HEROICON IMAGE -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6 text-blue-600"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l9-4 9 4M3 7l9 6 9-6" />
                </svg>

                Daftar Galeri Wisata
            </h2>
            <p class="text-gray-500 text-sm">Kelola foto galeri wisata</p>
        </div>

        <a href="{{ route('admin.galleries.create') }}"
           class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">

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
    <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">

        <!-- HEROICON CHECK -->
        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2"
                d="M5 13l4 4L19 7" />
        </svg>

        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE CARD -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- HEAD -->
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Judul</th>
                        <th class="px-6 py-4 text-left">Deskripsi</th>
                        <th class="px-6 py-4 text-left">Foto</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y">

                    @forelse($galleries as $item)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4">
                            {{ $loop->iteration + ($galleries->currentPage()-1) * $galleries->perPage() }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $item->title }}
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ $item->description ? Str::limit($item->description, 60) : '-' }}
                        </td>

                        <td class="px-6 py-4">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}"
                                     class="w-20 h-14 object-cover rounded-lg shadow border">
                            @else
                                <span class="text-gray-400 text-sm">Tidak ada</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 flex justify-center gap-2">

                            <!-- EDIT -->
                            <a href="{{ route('admin.galleries.edit',$item->id) }}"
                               class="p-2 rounded-lg bg-yellow-100 hover:bg-yellow-200 text-yellow-600">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5h2M12 7v10m-6 4h12a2 2 0 002-2V7a2 2 0 00-2-2h-3l-1-2h-4l-1 2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>

                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('admin.galleries.destroy',$item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus foto ini?')"
                                        class="p-2 rounded-lg bg-red-100 hover:bg-red-200 text-red-600">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"/>
                                    </svg>

                                </button>
                            </form>

                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-12">

                            <div class="flex flex-col items-center text-gray-400">

                                <!-- HEROICON EMPTY -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-12 h-12 mb-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 7l9-4 9 4M3 7l9 6 9-6M3 17l9 4 9-4"/>
                                </svg>

                                <span>Belum ada data galeri</span>
                            </div>

                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $galleries->links() }}
    </div>

</div>

@endsection