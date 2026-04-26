@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">

            <!-- HEROICON EDIT -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6 text-blue-600"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M11 5h2M12 7v10m-6 4h12a2 2 0 002-2V7a2 2 0 00-2-2h-3l-1-2h-4l-1 2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>

            Edit Gallery
        </h2>
        <p class="text-gray-500 text-sm">Perbarui data galeri</p>
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

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow p-6">

        <form action="{{ route('admin.galleries.update', $gallery->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf
            @method('PUT')

            <!-- TITLE -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Judul
                </label>
                <input type="text" name="title"
                    value="{{ old('title', $gallery->title) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>

            <!-- DESCRIPTION -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Deskripsi
                </label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">{{ old('description', $gallery->description) }}</textarea>
            </div>

            <!-- IMAGE -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar
                </label>

                <!-- Upload -->
                <label class="flex items-center gap-3 border px-4 py-2 rounded-lg cursor-pointer hover:bg-gray-50 transition">

                    <!-- HEROICON UPLOAD -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-gray-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M4 12l4-4m0 0l4 4m-4-4v12"/>
                    </svg>

                    <span id="fileName" class="text-sm text-gray-600">
                        Ganti gambar (opsional)
                    </span>

                    <input type="file" name="image" class="hidden" onchange="previewImage(event)">
                </label>

                <!-- CURRENT IMAGE -->
                <div class="mt-4">
                    <p class="text-xs text-gray-400 mb-2">Gambar saat ini</p>
                    <img src="{{ asset('storage/'.$gallery->image) }}"
                         class="w-full max-w-sm rounded-xl shadow border object-cover">
                </div>

                <!-- NEW PREVIEW -->
                <img id="preview"
                     class="hidden mt-4 w-full max-w-sm rounded-xl shadow border object-cover">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-between pt-4">

                <!-- BACK -->
                <a href="{{ route('admin.galleries.index') }}"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">

                    <!-- HEROICON BACK -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"/>
                    </svg>

                    Batal
                </a>

                <!-- SAVE -->
                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white shadow">

                    <!-- HEROICON CHECK -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                    </svg>

                    Update
                </button>

            </div>

        </form>

    </div>

</div>

<!-- SCRIPT -->
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