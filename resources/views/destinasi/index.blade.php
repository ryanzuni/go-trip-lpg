@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold text-primary">Daftar Destinasi Wisata</h5>
                <a href="{{ route('destinasi.create') }}" class="btn btn-primary btn-sm">
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
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($destinasi as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($destinasi->currentPage()-1) * $destinasi->perPage() }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->harga_tiket ? 'Rp ' . number_format($item->harga_tiket,0,',','.') : '-' }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" width="80" class="rounded-3">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('destinasi.edit',$item->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('destinasi.destroy',$item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
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
