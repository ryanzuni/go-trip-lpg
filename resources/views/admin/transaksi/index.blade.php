@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold text-primary">Daftar Transaksi</h5>
                <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary btn-sm">
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
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $i => $transaksi)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $transaksi->nama_pelanggan }}</td>
            <td>{{ $transaksi->paketWisata->nama_paket ?? '-' }}</td>
            <td>{{ $transaksi->jumlah_orang }}</td>
            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_berangkat)->format('d M Y') }}</td>
            <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            <td>{{ ucfirst($transaksi->status) }}</td>
            <td>
                <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
@endsection
