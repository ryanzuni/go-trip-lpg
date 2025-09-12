@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <!-- Header -->
            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold text-primary">Daftar Galeri Wisata</h5>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            <!-- Flash message -->
            @if(session('success'))
                <div class="alert alert-primary alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($galleries->currentPage()-1) * $galleries->perPage() }}</td>
                            <td class="fw-semibold text-dark">{{ $item->title }}</td>
                            <td>{{ $item->description ? Str::limit($item->description, 50) : '-' }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}" width="100" class="rounded-3 shadow-sm border border-2 border-primary">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.galleries.edit',$item->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.galleries.destroy',$item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin hapus foto ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-image-alt fs-3 d-block mb-2 text-secondary"></i>
                                Belum ada data galeri
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $galleries->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
