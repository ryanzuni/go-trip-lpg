@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white py-3 rounded-top-4">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Gallery</h5>
        </div>
        <div class="card-body p-4">

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul</label>
                    <input type="text" name="title" class="form-control" 
                           value="{{ old('title', $gallery->title) }}" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $gallery->description) }}</textarea>
                </div>

                {{-- Image Upload --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar</label>
                    <input type="file" name="image" class="form-control">
                    <div class="mt-3">
                        <p class="text-muted small mb-1">Gambar saat ini:</p>
                        <img src="{{ asset('storage/'.$gallery->image) }}" class="img-fluid rounded-3 shadow-sm" style="max-width: 350px;">
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-check-circle"></i> Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
