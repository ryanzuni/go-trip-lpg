@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">

            <!-- HEROICON -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6 text-blue-600"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>

            Tambah Gallery
        </h2>
        <p class="text-gray-500 text-sm">Upload foto ke galeri wisata</p>
    </div>

    <!-- ERROR -->
    @if ($errors->any())
    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
        <ul class="list-disc pl-5 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- FORM CARD -->
    <div class="bg-white rounded-2xl shadow p-6">

        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- JUDUL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Judul
                    </label>
                    <input type="text" name="title"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Masukkan judul foto..." required>
                </div>

                <!-- UPLOAD -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Gambar
                    </label>

                    <label class="flex items-center gap-3 border px-4 py-2 rounded-lg cursor-pointer hover:bg-gray-50 transition">

                        <!-- HEROICON UPLOAD -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M4 12l4-4m0 0l4 4m-4-4v12" />
                        </svg>

                        <span class="text-sm text-gray-600" id="fileName">Pilih file</span>

                        <input type="file" name="image" class="hidden" accept="image/*" required onchange="previewImage(event)">
                    </label>
                </div>

            </div>

            <!-- PREVIEW -->
            <img id="preview"
                 class="hidden w-full max-h-64 object-cover rounded-xl border shadow">

            <!-- DESKRIPSI -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Deskripsi
                </label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                    placeholder="Tulis deskripsi singkat..."></textarea>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('admin.galleries.index') }}"
                   class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">
                    Batal
                </a>

                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">

                    <!-- HEROICON SAVE -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>

                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>

<!-- SCRIPT PREVIEW -->
<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    const fileName = document.getElementById('fileName');

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
        fileName.textContent = file.name;
    }
}
</script>

@endsection