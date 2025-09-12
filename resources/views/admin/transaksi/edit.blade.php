@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">✏️ Edit Transaksi</h5>
            <form action="{{ route('transaksi.update',$transaksi->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" value="{{ $transaksi->nama_pelanggan }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $transaksi->email }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="{{ $transaksi->telepon }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Paket Wisata</label>
                    <select name="paket_id" class="form-select" required>
                        @foreach($paket as $p)
                            <option value="{{ $p->id }}" {{ $transaksi->paket_id==$p->id?'selected':'' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Orang</label>
                    <input type="number" name="jumlah_orang" class="form-control" value="{{ $transaksi->jumlah_orang }}" min="1">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat" class="form-control" value="{{ $transaksi->tanggal_berangkat->format('Y-m-d') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Harga</label>
                    <input type="number" name="total_harga" class="form-control" value="{{ $transaksi->total_harga }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ $transaksi->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="lunas" {{ $transaksi->status=='lunas'?'selected':'' }}>Lunas</option>
                        <option value="batal" {{ $transaksi->status=='batal'?'selected':'' }}>Batal</option>
                    </select>
                </div>
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
