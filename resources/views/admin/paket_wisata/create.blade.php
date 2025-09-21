@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">➕ Tambah Paket Wisata</h5>

            <form action="{{ route('admin.paket_wisata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control" value="{{ old('nama_paket') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Destinasi</label>
                    <select name="destinasi_id" class="form-select" required>
                        <option value="">-- Pilih Destinasi --</option>
                        @foreach($destinasi as $d)
                            <option value="{{ $d->id }}" {{ old('destinasi_id') == $d->id ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="harga_weekday" class="form-label">Harga Weekday</label>
                    <input type="number" name="harga_weekday" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="harga_weekend" class="form-label">Harga Weekend / Long Weekend</label>
                    <input type="number" name="harga_weekend" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Durasi (Hari)</label>
                    <input type="number" name="durasi_hari" class="form-control" value="{{ old('durasi_hari') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fasilitas</label>
                    <input type="text" name="fasilitas" class="form-control" value="{{ old('fasilitas') }}" placeholder="Contoh: Hotel, Makan 3x, Tour Guide">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('admin.paket_wisata.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
