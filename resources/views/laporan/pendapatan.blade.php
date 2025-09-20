@extends('layouts.app')
@section('title','Laporan Pendapatan')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">📊 Laporan Pendapatan</h5>

            {{-- Filter --}}
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="month" name="bulan" class="form-control" value="{{ request('bulan') }}">
                </div>
                <div class="col-md-3">
                    <select name="paket" class="form-select">
                        <option value="">Semua Paket</option>
                        @foreach(\App\Models\PaketWisata::all() as $paket)
                        <option value="{{ $paket->id }}" {{ request('paket')==$paket->id?'selected':'' }}>{{ $paket->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Paket Wisata</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendapatanPaket as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['nama_paket'] }}</td>
                        <td>{{ $item['jumlah_transaksi'] }}</td>
                        <td>Rp {{ number_format($item['total_pendapatan'],0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Export --}}
            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('admin.laporan.pendapatan', array_merge(request()->all(), ['export'=>'pdf'])) }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </a>
                <a href="{{ route('admin.laporan.pendapatan', array_merge(request()->all(), ['export'=>'excel'])) }}" class="btn btn-success">
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
