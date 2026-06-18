@extends('layouts.app')

@section('content')

<div class="p-6 max-w-6xl">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Paket Wisata</h2>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow p-6">

        <form action="{{ route('admin.paket_wisata.update', $paket_wisatum->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- LEFT -->
                <div class="space-y-5">

                    <!-- Nama -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Nama Paket</label>
                        <input type="text" name="nama_paket"
                            value="{{ old('nama_paket', $paket_wisatum->nama_paket) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                            required>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Jenis Layanan
                        </label>

                        <select
                            name="jenis_layanan"
                            id="jenis_layanan"
                            class="w-full mt-1 px-4 py-2 border rounded-lg">

                            <option value="open_trip"
                                {{ old('jenis_layanan',$paket_wisatum->jenis_layanan) == 'open_trip' ? 'selected' : '' }}>
                                Open Trip
                            </option>

                            <option value="private_trip"
                                {{ old('jenis_layanan',$paket_wisatum->jenis_layanan) == 'private_trip' ? 'selected' : '' }}>
                                Private Trip
                            </option>

                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Tipe Harga
                        </label>

                        <select
                            name="tipe_harga"
                            class="w-full mt-1 px-4 py-2 border rounded-lg">

                            <option value="per_orang"
                                {{ old('tipe_harga',$paket_wisatum->tipe_harga) == 'per_orang' ? 'selected' : '' }}>
                                Per Orang
                            </option>

                            <option value="per_grup"
                                {{ old('tipe_harga',$paket_wisatum->tipe_harga) == 'per_grup' ? 'selected' : '' }}>
                                Per Grup
                            </option>

                        </select>
                    </div>

                    <!-- Destinasi -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Destinasi</label>
                        <select id="destinasi-select"
                            name="destinasi_id[]"
                            multiple
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

                            @foreach($destinasi as $d)
                            <option value="{{ $d->id }}"
                                {{ in_array($d->id, old('destinasi_id', $paket_wisatum->destinasi->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">{{ old('deskripsi', $paket_wisatum->deskripsi) }}</textarea>
                    </div>

                    <!-- Fasilitas -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Fasilitas</label>
                        <input type="text" name="fasilitas"
                            value="{{ old('fasilitas', $paket_wisatum->fasilitas) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="space-y-5">

                    <!-- OPEN TRIP -->
                    <div id="openTripPrice">

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="text-sm font-medium text-gray-700">
                                    Harga Weekday
                                </label>

                                <input
                                    type="number"
                                    name="harga_weekday"
                                    value="{{ old('harga_weekday',$paket_wisatum->harga_weekday) }}"
                                    class="w-full mt-1 px-4 py-2 border rounded-lg">
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-700">
                                    Harga Weekend
                                </label>

                                <input
                                    type="number"
                                    name="harga_weekend"
                                    value="{{ old('harga_weekend',$paket_wisatum->harga_weekend) }}"
                                    class="w-full mt-1 px-4 py-2 border rounded-lg">
                            </div>

                        </div>

                    </div>

                    <!-- PRIVATE TRIP -->

                    <div id="privateTripPrice" class="hidden">

                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">

                            <div class="flex items-center justify-between mb-4">

                                <div>
                                    <h3 class="font-bold text-blue-700">
                                        Harga Private Trip
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Harga berdasarkan jumlah peserta
                                    </p>
                                </div>

                                <button
                                    type="button"
                                    id="addRange"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">

                                    + Tambah Range

                                </button>

                            </div>

                            <div id="private-ranges">

                                @if($paket_wisatum->privatePrices->count())

                                @foreach($paket_wisatum->privatePrices as $price)

                                <div class="grid grid-cols-4 gap-3 mb-3">

                                    <div>
                                        <label class="text-xs text-gray-500">
                                            Min Peserta
                                        </label>

                                        <input
                                            type="number"
                                            name="private[min][]"
                                            value="{{ $price->min_peserta }}"
                                            class="w-full mt-1 px-3 py-2 border rounded-lg">
                                    </div>

                                    <div>
                                        <label class="text-xs text-gray-500">
                                            Max Peserta
                                        </label>

                                        <input
                                            type="number"
                                            name="private[max][]"
                                            value="{{ $price->max_peserta }}"
                                            class="w-full mt-1 px-3 py-2 border rounded-lg">
                                    </div>

                                    <div>
                                        <label class="text-xs text-gray-500">
                                            Harga Weekday
                                        </label>

                                        <input
                                            type="number"
                                            name="private[weekday][]"
                                            value="{{ $price->harga_weekday }}"
                                            class="w-full mt-1 px-3 py-2 border rounded-lg">
                                    </div>

                                    <div>
                                        <label class="text-xs text-gray-500">
                                            Harga Weekend
                                        </label>

                                        <input
                                            type="number"
                                            name="private[weekend][]"
                                            value="{{ $price->harga_weekend }}"
                                            class="w-full mt-1 px-3 py-2 border rounded-lg">
                                    </div>

                                </div>

                                @endforeach

                                @else

                                <div class="grid grid-cols-4 gap-3">

                                    <div>
                                        <label class="text-xs text-gray-500">
                                            Min Peserta
                                        </label>

                                        <input
                                            type="number"
                                            name="private[min][]"
                                            class="w-full mt-1 px-3 py-2 border rounded-lg">
                                    </div>

                                    <div>
                                        <label class="text-xs text-gray-500">
                                            Max Peserta
                                        </label>

                                        <input
                                            type="number"
                                            name="private[max][]"
                                            class="w-full mt-1 px-3 py-2 border rounded-lg">
                                    </div>

                                    <div>
                                        <label class="text-xs text-gray-500">
                                            Harga Weekday
                                        </label>

                                        <input
                                            type="number"
                                            name="private[weekday][]"
                                            class="w-full mt-1 px-3 py-2 border rounded-lg">
                                    </div>

                                    <div>
                                        <label class="text-xs text-gray-500">
                                            Harga Weekend
                                        </label>

                                        <input
                                            type="number"
                                            name="private[weekend][]"
                                            class="w-full mt-1 px-3 py-2 border rounded-lg">
                                    </div>

                                </div>

                                @endif

                            </div>

                        </div>

                    </div>


                    <!-- Durasi -->
                    <div>
                        <label class="text-sm text-gray-600 mb-1 block">Durasi (Hari)</label>
                        <input type="number" name="durasi_hari"
                            value="{{ old('durasi_hari', $paket_wisatum->durasi_hari) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                            required>
                    </div>

                    <!-- FOTO -->
                    <div>
                        <label class="text-sm text-gray-600 mb-2 block">Foto</label>

                        @if($paket_wisatum->foto)
                        <img src="{{ asset('storage/'.$paket_wisatum->foto) }}"
                            class="w-full h-40 object-cover rounded-xl mb-3 border">
                        @endif

                        <input type="file" name="foto"
                            class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4
                                   file:rounded-lg file:border-0
                                   file:bg-gray-100 file:text-gray-700
                                   hover:file:bg-gray-200">

                        @error('foto')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                        @enderror

                        <p class="text-sm text-gray-500 mt-2">
                            Maksimal ukuran foto 5MB
                        </p>
                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3 pt-4 border-t">

                <a href="{{ route('admin.paket_wisata.index') }}"
                    class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    Batal
                </a>

                <button type="submit"
                    class="flex items-center gap-2 px-5 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 shadow transition">

                    <!-- HEROICON CHECK -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>

                    Update
                </button>

            </div>

        </form>

    </div>

</div>

<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
    new TomSelect("#destinasi-select", {
        plugins: ['remove_button'],
        placeholder: "Pilih destinasi",
    });
</script>

@endsection