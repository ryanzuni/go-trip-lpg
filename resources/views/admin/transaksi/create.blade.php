@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">➕ Tambah Transaksi</h5>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Paket Wisata</label>
                    <!-- <select name="paket_id" class="form-select" required>
                        <option value="">-- Pilih Paket --</option>
                        @foreach($paketwisata as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select> -->
                    <select name="paket_id" class="form-control">
                        @foreach($paketwisata as $paketwisata)
                            <option value="{{ $paketwisata->id }}">{{ $paketwisata->nama_paket }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Orang</label>
                    <input type="number" name="jumlah_orang" class="form-control" value="1" min="1">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Harga</label>
                    <input type="number" name="total_harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending">Pending</option>
                        <option value="lunas">Lunas</option>
                        <option value="batal">Batal</option>
                    </select>
                </div>
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
