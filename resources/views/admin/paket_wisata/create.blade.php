@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">

                <!-- HEROICON PLUS -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6 text-blue-600"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>

                Tambah Paket Wisata
            </h2>
            <p class="text-gray-500 text-sm">Isi data paket wisata dengan lengkap</p>
        </div>
    </div>

    <!-- GRID -->
    <form action="{{ route('admin.paket_wisata.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT FORM -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6 space-y-5">

                <!-- Nama -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Paket</label>
                    <input type="text" name="nama_paket"
                        value="{{ old('nama_paket') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Destinasi -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Destinasi</label>
                    <select id="destinasi-select" name="destinasi_id[]" multiple
                        class="w-full mt-1 px-4 py-2 border rounded-lg">

                        @foreach($destinasi as $d)
                        <option value="{{ $d->id }}">
                            {{ $d->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Harga -->
                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium text-gray-700">Harga Weekday</label>
                        <input type="number" name="harga_weekday"
                            value="{{ old('harga_weekday') }}"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Harga Weekend</label>
                        <input type="number" name="harga_weekend"
                            value="{{ old('harga_weekend') }}"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                </div>

                <!-- Durasi -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Durasi (Hari)</label>
                    <input type="number" name="durasi_hari"
                        value="{{ old('durasi_hari') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Fasilitas -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Fasilitas</label>
                    <input type="text" name="fasilitas"
                        value="{{ old('fasilitas') }}"
                        placeholder="Hotel, Makan, Guide"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-3 pt-4">

                    <a href="{{ route('admin.paket_wisata.index') }}"
                        class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">
                        Batal
                    </a>

                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow">

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

            </div>

            <!-- RIGHT PANEL -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h4 class="font-semibold text-gray-700 mb-4">Upload Foto</h4>

                <label class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl h-48 cursor-pointer hover:bg-gray-50 transition">
                    <span class="text-gray-400 text-sm">Klik untuk upload</span>
                    <input type="file"
                        name="foto"
                        accept="image/*"
                        class="hidden"
                        onchange="previewImage(event)">

                    @error('foto')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                    @enderror

                    <p class="text-sm text-gray-500 mt-2">
                        Maksimal ukuran foto 5MB
                    </p>
                </label>

                <!-- PREVIEW -->
                <img id="preview"
                    class="mt-4 w-full h-48 object-cover rounded-xl hidden">

            </div>

        </div>

    </form>

</div>

<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect("#destinasi-select", {
        plugins: ['remove_button'],
        placeholder: "Pilih destinasi",
    });
</script>

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