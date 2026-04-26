@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Destinasi</h2>
        <p class="text-gray-500 text-sm">Isi data destinasi dengan lengkap</p>
    </div>

    <!-- GRID LAYOUT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- FORM -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">

            <form action="{{ route('admin.destinasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Destinasi</label>
                    <input type="text" name="nama"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                    placeholder="Contoh: Pantai Lampung">
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="lokasi"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                    placeholder="Contoh: Lampung Selatan">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="5"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                    placeholder="Tulis deskripsi destinasi..."></textarea>
                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.destinasi.index') }}"
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">
                        Batal
                    </a>

                    <button type="submit"
                    class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                        Simpan
                    </button>
                </div>

            </form>
        </div>

        <!-- SIDE PANEL (PREVIEW / UPLOAD) -->
        <div class="bg-white rounded-2xl shadow p-6">

            <h4 class="font-semibold text-gray-700 mb-4">Upload Foto</h4>

            <label class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl h-48 cursor-pointer hover:bg-gray-50 transition">
                <span class="text-gray-400 text-sm">Klik untuk upload</span>
                <input type="file" name="foto" class="hidden" onchange="previewImage(event)">
            </label>

            <!-- Preview -->
            <img id="preview"
            class="mt-4 w-full h-48 object-cover rounded-xl hidden">

        </div>

    </div>

</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    }
}
</script>

@endsection