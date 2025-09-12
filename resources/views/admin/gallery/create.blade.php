@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Gallery</h5>
        </div>
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" name="title" class="form-control" placeholder="Masukkan judul foto..." required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Gambar</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Tulis deskripsi singkat..."></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary me-2">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
