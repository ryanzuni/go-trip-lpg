@extends('layouts.app')

@section('content')

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Destinasi Wisata</h2>

        <a href="{{ route('admin.destinasi.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            + Tambah
        </a>
    </div>

    <!-- SUCCESS -->
    @if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wide">
                <tr>
                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Lokasi</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($destinasi as $item)

                <!-- ROW -->
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-gray-400">
                        {{ $loop->iteration + ($destinasi->currentPage()-1) * $destinasi->perPage() }}
                    </td>

                    <td class="p-4 font-semibold text-gray-800">
                        {{ $item->nama }}
                    </td>

                    <td class="p-4 text-gray-500">
                        {{ $item->lokasi }}
                    </td>

                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-2">

                            <!-- VIEW -->
                            <button onclick="openModal({{ $item->id }})"
                                class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 
                                        8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 
                                        7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>

                            <!-- EDIT -->
                            <a href="{{ route('admin.destinasi.edit',$item->id) }}"
                                class="p-2 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-500 hover:text-white transition">
                                ✏️
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('admin.destinasi.destroy',$item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')"
                                    class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition">
                                    🗑
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                <!-- ✅ MODAL (WAJIB DI SINI) -->
                <div id="modal{{ $item->id }}"
                    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

                    <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl overflow-hidden">

                        <!-- HEADER -->
                        <div class="flex justify-between items-center px-6 py-4 border-b">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Detail Destinasi
                            </h3>

                            <button onclick="closeModal({{ $item->id }})"
                                class="text-gray-400 hover:text-red-500">
                                ✕
                            </button>
                        </div>

                        <!-- IMAGE -->
                        @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}"
                            class="w-full h-60 object-cover">
                        @endif

                        <!-- CONTENT -->
                        <div class="p-6 space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="font-semibold text-gray-800">{{ $item->nama }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="text-gray-700">{{ $item->lokasi }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Deskripsi</p>
                                <p class="text-gray-600 text-sm">
                                    {{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                                </p>
                            </div>
                        </div>

                        <!-- FOOTER -->
                        <div class="px-6 py-4 border-t flex justify-end">
                            <button onclick="closeModal({{ $item->id }})"
                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                                Tutup
                            </button>
                        </div>

                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="4" class="text-center p-6 text-gray-400">
                        Belum ada data
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>

    <!-- PAGINATION -->
    <div>
        {{ $destinasi->links() }}
    </div>

</div>

<!-- SCRIPT -->
<script>
function openModal(id) {
    document.getElementById('modal' + id).classList.remove('hidden');
    document.getElementById('modal' + id).classList.add('flex');
}

function closeModal(id) {
    document.getElementById('modal' + id).classList.add('hidden');
}
</script>

@endsection