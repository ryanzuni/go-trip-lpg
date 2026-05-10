@extends('layouts.app')

@section('content')

<div class="p-6 space-y-6">

    <!-- ===== HEADER ===== -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Destinasi Wisata
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola data destinasi wisata GoTrip
            </p>
        </div>

        <a href="{{ route('admin.destinasi.create') }}"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-5 py-3 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition duration-300">

            <span class="text-lg">+</span>
            Tambah Destinasi
        </a>
    </div>


    <!-- SUCCESS -->
    @if(session('success'))
    <div class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl shadow-sm">
        {{ session('success') }}
    </div>
    @endif


    <!-- ===== TABLE CARD ===== -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

        <!-- TOP -->
        <div class="flex items-center justify-between px-6 py-5 border-b bg-gradient-to-r from-gray-50 to-white">

            <div>
                <h2 class="text-lg font-bold text-gray-800">
                    Daftar Destinasi
                </h2>

                <p class="text-sm text-gray-500">
                    Total {{ $destinasi->total() }} destinasi wisata
                </p>
            </div>

            <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">
                <i class="fas fa-map-marked-alt text-blue-600 text-lg"></i>
            </div>
        </div>


        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50 text-gray-500 text-sm uppercase tracking-wider">

                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Destinasi</th>
                        <th class="px-6 py-4 text-left">Lokasi</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($destinasi as $item)

                    <tr class="hover:bg-blue-50/40 transition duration-200">

                        <!-- NUMBER -->
                        <td class="px-6 py-5 text-gray-400 font-medium">
                            {{ $loop->iteration + ($destinasi->currentPage()-1) * $destinasi->perPage() }}
                        </td>

                        <!-- DESTINASI -->
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <!-- IMAGE -->
                                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow">

                                    @if($item->foto)
                                    <img src="{{ asset('storage/'.$item->foto) }}"
                                        class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                    @endif

                                </div>

                                <!-- INFO -->
                                <div>
                                    <h3 class="font-bold text-gray-800 text-base">
                                        {{ $item->nama }}
                                    </h3>

                                    <p class="text-sm text-gray-400 mt-1">
                                        ID Destinasi #{{ $item->id }}
                                    </p>
                                </div>

                            </div>

                        </td>

                        <!-- LOKASI -->
                        <td class="px-6 py-5">

                            <div class="inline-flex items-center gap-2 px-3 py-2 bg-gray-100 rounded-xl text-sm text-gray-600">

                                <i class="fas fa-map-marker-alt text-red-500"></i>

                                {{ $item->lokasi }}

                            </div>

                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-3">

                                <!-- VIEW -->
                                <button onclick="openModal({{ $item->id }})"
                                    class="w-11 h-11 rounded-xl bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition flex items-center justify-center shadow-sm">

                                    <i class="fas fa-eye"></i>
                                </button>


                                <!-- EDIT -->
                                <a href="{{ route('admin.destinasi.edit',$item->id) }}"
                                    class="w-11 h-11 rounded-xl bg-yellow-100 text-yellow-600 hover:bg-yellow-500 hover:text-white transition flex items-center justify-center shadow-sm">

                                    <i class="fas fa-pen"></i>
                                </a>


                                <!-- DELETE -->
                                <form action="{{ route('admin.destinasi.destroy',$item->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Yakin ingin menghapus destinasi ini?')"
                                        class="w-11 h-11 rounded-xl bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition flex items-center justify-center shadow-sm">

                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    <!-- ===== MODAL ===== -->
                    <div id="modal{{ $item->id }}"
                        class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4 overflow-y-auto">

                        <div class="bg-white w-full max-w-2xl rounded-3xl overflow-hidden shadow-2xl animate-fadeIn my-10 max-h-[90vh] overflow-y-auto">

                            <!-- IMAGE -->
                            @if($item->foto)
                            <div class="relative h-72">

                                <img src="{{ asset('storage/'.$item->foto) }}"
                                    class="w-full h-full object-cover">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                                <div class="absolute bottom-5 left-6 text-white">
                                    <h2 class="text-3xl font-bold">
                                        {{ $item->nama }}
                                    </h2>

                                    <p class="text-sm opacity-90 mt-1">
                                        {{ $item->lokasi }}
                                    </p>
                                </div>

                                <button onclick="closeModal({{ $item->id }})"
                                    class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/20 backdrop-blur text-white hover:bg-red-500 transition">

                                    ✕
                                </button>

                            </div>
                            @endif


                            <!-- CONTENT -->
                            <div class="p-6 space-y-5">

                                <div>

                                    <p class="text-sm text-gray-400 mb-1">
                                        Lokasi
                                    </p>

                                    <div class="inline-flex items-center gap-2 bg-red-50 text-red-600 px-4 py-2 rounded-xl text-sm">

                                        <i class="fas fa-map-marker-alt"></i>

                                        {{ $item->lokasi }}

                                    </div>

                                </div>


                                <div>

                                    <p class="text-sm text-gray-400 mb-2">
                                        Deskripsi
                                    </p>

                                    <p class="text-gray-600 leading-relaxed">
                                        {{ $item->deskripsi ?? 'Tidak ada deskripsi destinasi.' }}
                                    </p>

                                </div>

                            </div>


                            <!-- FOOTER -->
                            <div class="px-6 py-5 border-t bg-gray-50 flex justify-end">

                                <button onclick="closeModal({{ $item->id }})"
                                    class="px-5 py-2.5 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition">

                                    Tutup
                                </button>

                            </div>

                        </div>

                    </div>

                    @empty

                    <tr>
                        <td colspan="4" class="py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                    <i class="fas fa-map text-3xl text-gray-400"></i>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-700">
                                    Belum Ada Destinasi
                                </h3>

                                <p class="text-gray-400 text-sm mt-1">
                                    Tambahkan destinasi wisata baru
                                </p>

                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

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
        document.getElementById('modal' + id).classList.remove('flex');
    }
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fadeIn {
        animation: fadeIn .25s ease;
    }
</style>

@endsection