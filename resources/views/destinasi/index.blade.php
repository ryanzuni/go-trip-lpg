@extends('layouts.app')

@section('content')
<style>
/* Backdrop blur */
.modal-backdrop.show {
    backdrop-filter: blur(6px);
    background-color: rgba(0,0,0,0.35);
}

/* Modal card-style premium */
.modal-content {
    border-radius: 1.5rem;
    box-shadow: 0 20px 50px rgba(0,0,0,0.4);
    padding: 0;
    position: relative;
    background: #fff;
    transform: scale(0.95);
    opacity: 0;
    transition: transform 0.25s ease-out, opacity 0.25s ease-out;
}

.modal.show .modal-content {
    transform: scale(1);
    opacity: 1;
}

/* Floating Close X di atas modal */
.modal-close-float {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #ff5e5e;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    font-weight: bold;
    box-shadow: 0 6px 15px rgba(0,0,0,0.5);
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s, background 0.2s, filter 0.2s;

    /* Fix biar bisa diklik */
    z-index: 9999;
    pointer-events: auto;
}

.modal-close-float:hover {
    transform: scale(1.2) rotate(15deg);
    box-shadow: 0 10px 25px rgba(0,0,0,0.7);
    filter: drop-shadow(0 0 8px #ff7878);
    background: #ff7878;
}

/* Foto atas */
.modal-img {
    width: 100%;
    height: auto;
    max-height: 350px;
    object-fit: cover;
    border-radius: 1.5rem 1.5rem 0 0;
    box-shadow: 0 5px 20px rgba(0,0,0,0.25);
    transition: transform 0.4s, opacity 0.4s;
    opacity: 0;
    transform: scale(0.95);
}

.modal.show .modal-img {
    opacity: 1;
    transform: scale(1);
}

.modal-img:hover {
    transform: scale(1.03);
}

/* Deskripsi bawah */
.modal-description {
    padding: 1rem 1.5rem 1.5rem 1.5rem;
    max-height: 300px;
    overflow-y: auto;
    background: linear-gradient(180deg, #fff, #f9f9f9);
    border-top: 1px solid #e0e0e0;
    box-shadow: inset 0 2px 8px rgba(0,0,0,0.05);
}

.modal-description h6 {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.modal-description p {
    font-size: 0.95rem;
    line-height: 1.6;
    margin: 0;
}
</style>

<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold text-primary">Daftar Destinasi Wisata</h5>
                <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($destinasi as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($destinasi->currentPage()-1) * $destinasi->perPage() }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>
                            <!-- Tombol View (Modal) -->
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $item->id }}">
                                <i class="bi bi-eye"></i>
                            </button>

                            <a href="{{ route('admin.destinasi.edit',$item->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.destinasi.destroy',$item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal foto & deskripsi bawah -->
                    <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1"
                         aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered modal-lg position-relative">

                            <!-- Floating Close X (di luar modal-content) -->
                            <div class="modal-close-float" data-bs-dismiss="modal">&times;</div>

                            <div class="modal-content">
                                <!-- Foto -->
                                @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" class="modal-img">
                                @endif

                                <!-- Deskripsi bawah -->
                                @if($item->deskripsi)
                                <div class="modal-description">
                                    <h6>Deskripsi:</h6>
                                    <p>{{ $item->deskripsi }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $destinasi->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
