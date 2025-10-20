@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">Edit Destinasi</h5>

            <form action="{{ route('admin.destinasi.update', $destinasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Destinasi</label>
                    <input type="text" name="nama" class="form-control" 
                           value="{{ old('nama', $destinasi->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" 
                           value="{{ old('lokasi', $destinasi->lokasi) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label><br>
                    @if($destinasi->foto)
                        <img src="{{ asset('storage/'.$destinasi->foto) }}" width="120" class="mb-2 rounded-3">
                    @endif
                    <input type="file" name="foto" class="form-control">
                </div>

                <button class="btn btn-success"><i class="bi bi-check-circle"></i> Update</button>
                <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
