@extends('layouts.app')
@section('title','Laporan Booking')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">Laporan Booking</h5>

            {{-- Filter --}}
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-2">
                    <input type="date" name="start" class="form-control" value="{{ request('start') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="end" class="form-control" value="{{ request('end') }}">
                </div>
                <div class="col-md-3">
                    <select name="paket_id" class="form-select">
                        <option value="">Semua Paket</option>
                        @foreach($pakets as $paket)
                            <option value="{{ $paket->id }}" {{ request('paket_id') == $paket->id ? 'selected' : '' }}>
                                {{ $paket->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                        <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Confirmed</option>
                        <option value="canceled" {{ request('status')=='canceled'?'selected':'' }}>Canceled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped align-middle" id="bookingTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Paket Wisata</th>
                            <th>Jumlah Orang</th>
                            <th>Harga Satuan</th>
                            <th>Total Pembayaran</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Tanggal Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $b)
                            @php
                                $tanggal = \Carbon\Carbon::parse($b->created_at);
                                $dayOfWeek = $tanggal->dayOfWeek;

                                if ($b->paketWisata) {
                                    $hargaSatuan = ($dayOfWeek == 0 || $dayOfWeek == 6) 
                                        ? $b->paketWisata->harga_weekend 
                                        : $b->paketWisata->harga_weekday;

                                    $total = $hargaSatuan * $b->jumlah_orang;
                                } else {
                                    $hargaSatuan = 0;
                                    $total = 0;
                                }
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->nama }}</td>
                                <td>{{ $b->email }}</td>
                                <td>{{ $b->telepon }}</td>
                                <td>{{ $b->paketWisata->nama_paket ?? '-' }}</td>
                                <td>{{ $b->jumlah_orang }}</td>
                                <td>Rp {{ number_format($b->harga_satuan, 0, ',', '.') }}</td>
                                <td class="fw-bold text-success">Rp {{ number_format($b->total_harga, 0, ',', '.') }}</td>
                                <td>{{ $b->catatan ?? '-' }}</td>
                                <td>{{ ucfirst($b->status) }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->tanggal_booking)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Export & Print --}}
            <div class="mt-3 d-flex gap-2">
                <button id="downloadCsv" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel"></i> Download CSV
                </button>
                <button id="printTable" class="btn btn-danger">
                    <i class="bi bi-printer"></i> Print
                </button>
            </div>
            
            {{-- Pagination --}}
            <div class="d-flex justify-content-left mt-2">
                {{ $bookings->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

{{-- JS Export & Print --}}
<script>
document.getElementById('downloadCsv').addEventListener('click', function(){
    let table = document.getElementById('bookingTable');
    let rows = Array.from(table.querySelectorAll('tr'));
    let csv = rows.map(row => {
        let cols = Array.from(row.querySelectorAll('th, td'));
        return cols.map(col => `"${col.innerText.replace(/"/g,'""')}"`).join(',');
    }).join('\n');

    let blob = new Blob([csv], { type: 'text/csv' });
    let url = URL.createObjectURL(blob);
    let a = document.createElement('a');
    a.href = url;
    a.download = 'laporan_booking.csv';
    a.click();
    URL.revokeObjectURL(url);
});

document.getElementById('printTable').addEventListener('click', function(){
    let divToPrint = document.querySelector('.card-body').innerHTML;
    let newWin = window.open('', '', 'width=900,height=700');
    newWin.document.write('<html><head><title>Laporan Booking</title>');
    newWin.document.write('<link rel="stylesheet" href="{{ asset("css/app.css") }}">'); 
    newWin.document.write('</head><body>');
    newWin.document.write(divToPrint);
    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.print();
});
</script>
@endsection
