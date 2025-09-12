@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">➕ Tambah Destinasi</h5>
            <form action="{{ route('destinasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Destinasi</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Tiket</label>
                    <input type="number" name="harga_tiket" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('destinasi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
