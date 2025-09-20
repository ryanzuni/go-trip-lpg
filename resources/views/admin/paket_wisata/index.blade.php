@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold text-primary">Daftar Paket Wisata</h5>
                <a href="{{ route('admin.paket_wisata.create') }}" class="btn btn-primary btn-sm">
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
                        <th>Nama Paket</th>
                        <th>Destinasi</th>
                        <th>Durasi</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paket as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_paket }}</td>
                        <td>{{ $item->destinasi->nama }}</td>
                        <td>{{ $item->durasi_hari }} Hari</td>
                        <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" width="80" class="rounded-3">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.paket_wisata.edit',$item->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.paket_wisata.destroy',$item->id) }}" 
                                  method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus paket ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada paket wisata.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Kalau pakai paginate --}}
            {{ $paket->links() }}
        </div>
    </div>
</div>
@endsection
