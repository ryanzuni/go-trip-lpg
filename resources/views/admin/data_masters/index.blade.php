@extends('layouts.app')

@section('title', 'Data Master')

@section('content')
<div class="container mt-4">
    <!-- <h3 class="mb-4 fw-bold text-primary">📂 Data Master Transaksi</h3> -->

    {{-- Filter --}}
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="all">Semua Status</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                <option value="lunas" {{ request('status')=='lunas'?'selected':'' }}>Lunas</option>
                <option value="batal" {{ request('status')=='batal'?'selected':'' }}>Batal</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-3">
            <table class="table table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Paket Wisata</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataMasters as $key => $item)
                    <tr class="text-center">
                        <td>{{ $dataMasters->firstItem() + $key }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>{{ $item->paketWisata->nama ?? '-' }}</td>
                        <td>{{ $item->jumlah_orang }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d M Y') }}</td>
                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge 
                                @if($item->status == 'lunas') bg-success 
                                @elseif($item->status == 'pending') bg-warning 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data master</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end mt-2">
                {{ $dataMasters->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
