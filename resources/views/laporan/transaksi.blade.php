@extends('layouts.app')
@section('title','Laporan Transaksi')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">📄 Laporan Transaksi</h5>

            {{-- Filter --}}
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="date" name="start" class="form-control" value="{{ request('start') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="end" class="form-control" value="{{ request('end') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                        <option value="lunas" {{ request('status')=='lunas'?'selected':'' }}>Lunas</option>
                        <option value="batal" {{ request('status')=='batal'?'selected':'' }}>Batal</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped align-middle" id="laporanTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Pelanggan</th>
                            <th>Paket Wisata</th>
                            <th>Jumlah Orang</th>
                            <th>Tanggal Berangkat</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->nama_pelanggan }}</td>
                            <td>{{ $t->paketWisata->nama ?? '-' }}</td>
                            <td>{{ $t->jumlah_orang }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->tanggal_berangkat)->format('d M Y') }}</td>
                            <td>Rp {{ number_format($t->total_harga,0,',','.') }}</td>
                            <td>{{ ucfirst($t->status) }}</td>
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
        </div>
    </div>
</div>

{{-- JS Export & Print --}}
<script>
document.getElementById('downloadCsv').addEventListener('click', function(){
    let table = document.getElementById('laporanTable');
    let rows = Array.from(table.querySelectorAll('tr'));
    let csv = rows.map(row => {
        let cols = Array.from(row.querySelectorAll('th, td'));
        return cols.map(col => `"${col.innerText.replace(/"/g,'""')}"`).join(',');
    }).join('\n');

    let blob = new Blob([csv], { type: 'text/csv' });
    let url = URL.createObjectURL(blob);
    let a = document.createElement('a');
    a.href = url;
    a.download = 'laporan_transaksi.csv';
    a.click();
    URL.revokeObjectURL(url);
});

document.getElementById('printTable').addEventListener('click', function(){
    let divToPrint = document.querySelector('.card-body').innerHTML;
    let newWin = window.open('', '', 'width=900,height=700');
    newWin.document.write('<html><head><title>Laporan Transaksi</title>');
    newWin.document.write('<link rel="stylesheet" href="{{ asset("css/app.css") }}">'); // optional styling
    newWin.document.write('</head><body>');
    newWin.document.write(divToPrint);
    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.print();
});
</script>
@endsection
