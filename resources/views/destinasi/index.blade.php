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

    <!-- TABLE CARD -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Lokasi</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($destinasi as $item)
                <tr class="hover:bg-gray-50 transition">

                    <td class="p-4">
                        {{ $loop->iteration + ($destinasi->currentPage()-1) * $destinasi->perPage() }}
                    </td>

                    <td class="p-4 font-medium text-gray-800">
                        {{ $item->nama }}
                    </td>

                    <td class="p-4 text-gray-500">
                        {{ $item->lokasi }}
                    </td>

                    <td class="p-4 text-center space-x-2">

                        <!-- VIEW -->
                        <button onclick="openModal({{ $item->id }})"
                        class="bg-blue-100 text-blue-600 px-3 py-1 rounded-lg hover:bg-blue-200">
                            👁
                        </button>

                        <!-- EDIT -->
                        <a href="{{ route('admin.destinasi.edit',$item->id) }}"
                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg hover:bg-yellow-200">
                            ✏️
                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('admin.destinasi.destroy',$item->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')"
                            class="bg-red-100 text-red-600 px-3 py-1 rounded-lg hover:bg-red-200">
                                🗑
                            </button>
                        </form>

                    </td>
                </tr>

                <!-- MODAL -->
                <div id="modal{{ $item->id }}"
                class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

                    <div class="bg-white rounded-2xl w-full max-w-xl shadow-xl overflow-hidden">

                        <!-- CLOSE -->
                        <div class="flex justify-end p-3">
                            <button onclick="closeModal({{ $item->id }})"
                            class="text-gray-400 hover:text-red-500 text-xl">
                                ✕
                            </button>
                        </div>

                        <!-- IMAGE -->
                        @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}"
                        class="w-full h-64 object-cover">
                        @endif

                        <!-- DESC -->
                        <div class="p-5">
                            <h3 class="font-bold text-lg mb-2">{{ $item->nama }}</h3>
                            <p class="text-gray-600 text-sm">
                                {{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                            </p>
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
    document.getElementById('modal'+id).classList.remove('hidden');
    document.getElementById('modal'+id).classList.add('flex');
}

function closeModal(id) {
    document.getElementById('modal'+id).classList.add('hidden');
}
</script>

@endsection