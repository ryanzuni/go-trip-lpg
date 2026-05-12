@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                Edit Destinasi
            </h2>
            <p class="text-muted mb-0">
                Perbarui informasi destinasi wisata
            </p>
        </div>

        <a href="{{ route('admin.destinasi.index') }}"
            class="btn btn-light border rounded-3 px-4">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        <!-- Top -->
        <div class="bg-primary px-4 py-3">
            <h5 class="text-white fw-semibold mb-0">
                Form Edit Destinasi
            </h5>
        </div>

        <!-- Body -->
        <div class="card-body p-4">

            <form action="{{ route('admin.destinasi.update', $destinasi->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- LEFT -->
                    <div class="col-lg-8">

                        <!-- Nama -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Nama Destinasi
                            </label>

                            <input type="text"
                                name="nama"
                                class="form-control custom-input"
                                placeholder="Masukkan nama destinasi"
                                value="{{ old('nama', $destinasi->nama) }}"
                                required>
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Lokasi
                            </label>

                            <input type="text"
                                name="lokasi"
                                class="form-control custom-input"
                                placeholder="Masukkan lokasi"
                                value="{{ old('lokasi', $destinasi->lokasi) }}"
                                required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-0">
                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea name="deskripsi"
                                rows="12"
                                class="form-control custom-textarea"
                                placeholder="Tulis deskripsi destinasi wisata...">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>

                            <small class="text-muted">
                                Gunakan enter untuk membuat paragraf.
                            </small>
                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-lg-4">

                        <label class="form-label fw-semibold">
                            Foto Destinasi
                        </label>

                        <!-- Preview -->
                        @if($destinasi->foto)
                        <div class="image-preview mb-3">
                            <img src="{{ asset('storage/'.$destinasi->foto) }}"
                                alt="Foto Destinasi">
                        </div>
                        @endif

                        <!-- Upload -->
                        <div class="upload-box">
                            <i class="bi bi-image fs-1 text-primary mb-2"></i>

                            <h6 class="fw-semibold mb-1">
                                Upload Foto Baru
                            </h6>

                            <p class="text-muted small mb-3">
                                JPG, PNG, JPEG
                            </p>

                            <input type="file"
                                name="foto"
                                class="form-control">
                        </div>

                    </div>

                </div>

                <!-- Button -->
                <div class="d-flex gap-3 mt-5">

                    <button type="submit"
                        class="btn btn-primary px-5 py-2 rounded-3 fw-semibold">

                        <i class="bi bi-check-circle"></i>
                        Update
                    </button>

                    <a href="{{ route('admin.destinasi.index') }}"
                        class="btn btn-light border px-4 py-2 rounded-3 fw-semibold">

                        Batal
                    </a>

                </div>

            </form>

        </div>
    </div>
</div>

<style>
    .custom-input {
        height: 52px;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        padding: 0 18px;
        font-size: 15px;
    }

    .custom-textarea {
        border-radius: 18px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        padding: 18px;
        font-size: 15px;
        resize: none;
    }

    .custom-input:focus,
    .custom-textarea:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.15);
        background: white;
    }

    .image-preview {
        width: 100%;
        height: 260px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .upload-box {
        border: 2px dashed #dbe3ef;
        border-radius: 20px;
        padding: 35px 20px;
        text-align: center;
        background: #f9fbff;
    }

    .card {
        background: white;
    }

    .btn-primary {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border: none;
    }

    .btn-primary:hover {
        opacity: 0.95;
    }
</style>
@endsection