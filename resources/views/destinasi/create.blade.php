@extends('layouts.app')

@section('content')

<div class="p-4 md:p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Tambah Destinasi
            </h2>

            <p class="text-gray-500 mt-1">
                Tambahkan destinasi wisata terbaru untuk GoTrip
            </p>
        </div>

        <a href="{{ route('admin.destinasi.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow transition">

            <i class="fas fa-arrow-left text-sm"></i>
            Kembali
        </a>

    </div>

    <!-- FORM -->
    <form action="{{ route('admin.destinasi.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <!-- LEFT -->
            <div class="xl:col-span-2">

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Informasi Destinasi
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Lengkapi informasi destinasi wisata dengan detail
                        </p>
                    </div>

                    <div class="space-y-6">

                        <!-- Nama -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Destinasi
                            </label>

                            <input type="text"
                                name="nama"
                                class="w-full h-14 px-5 rounded-2xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition"
                                placeholder="Contoh: Pantai Mutun"
                                required>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Lokasi
                            </label>

                            <input type="text"
                                name="lokasi"
                                class="w-full h-14 px-5 rounded-2xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition"
                                placeholder="Contoh: Pesawaran, Lampung"
                                required>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi
                            </label>

                            <textarea name="deskripsi"
                                rows="8"
                                class="w-full px-5 py-4 rounded-2xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition resize-none"
                                placeholder="Tulis deskripsi destinasi wisata..."></textarea>

                            <p class="text-xs text-gray-400 mt-2">
                                Gunakan enter untuk membuat paragraf lebih rapi
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sticky top-6">

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Upload Foto
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Upload gambar destinasi terbaik
                        </p>
                    </div>

                    <!-- Upload -->
                    <label class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-3xl h-72 cursor-pointer hover:border-blue-400 hover:bg-blue-50/40 transition overflow-hidden group">

                        <!-- Preview -->
                        <img id="preview"
                            class="absolute inset-0 w-full h-full object-cover hidden">

                        <!-- Placeholder -->
                        <div id="placeholder"
                            class="flex flex-col items-center">

                            <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mb-4 group-hover:scale-110 transition">

                                <i class="fas fa-image text-3xl text-blue-600"></i>
                            </div>

                            <p class="font-semibold text-gray-700">
                                Klik untuk upload
                            </p>

                            <span class="text-sm text-gray-400 mt-1">
                                PNG, JPG, JPEG
                            </span>
                        </div>

                        <input type="file"
                            name="foto"
                            class="hidden"
                            accept="image/*"
                            onchange="previewImage(event)">

                    </label>

                    <!-- BUTTON -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-6">

                        <a href="{{ route('admin.destinasi.index') }}"
                            class="w-full py-3 rounded-2xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-center font-semibold transition">

                            Batal
                        </a>

                        <button type="submit"
                            class="w-full py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:opacity-90 text-white font-semibold shadow-lg shadow-blue-200 transition">

                            Simpan
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

<script>
    function previewImage(event) {

        const file = event.target.files[0];

        if (file) {

            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('placeholder');

            preview.src = URL.createObjectURL(file);

            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
    }
</script>

@endsection