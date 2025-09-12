@extends('layouts.app')
@section('title','Laporan Paket Wisata')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">🏆 Laporan Paket Wisata</h5>

            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>Jumlah Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paketRanking as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['nama_paket'] }}</td>
                        <td>{{ $item['jumlah_transaksi'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Export --}}
            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('laporan.paket_wisata', array_merge(request()->all(), ['export'=>'pdf'])) }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </a>
                <a href="{{ route('laporan.paket_wisata', array_merge(request()->all(), ['export'=>'excel'])) }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>
            </div>

            @if($isPdf)
            <div class="mt-4 text-end">
                <p>Admin: {{ $adminName }}</p>
                <p>Tanggal: {{ $dateNow }}</p>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
