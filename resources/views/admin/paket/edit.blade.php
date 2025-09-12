@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">✏️ Edit Paket Wisata</h5>

            <form action="{{ route('paket-wisata.update', $paket_wisata->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control" value="{{ old('nama_paket', $paket_wisata->nama_paket) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Destinasi</label>
                    <select name="destinasi_id" class="form-select" required>
                        @foreach($destinasi as $d)
                            <option value="{{ $d->id }}" {{ $paket_wisata->destinasi_id == $d->id ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $paket_wisata->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $paket_wisata->harga) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Durasi (Hari)</label>
                    <input type="number" name="durasi_hari" class="form-control" value="{{ old('durasi_hari', $paket_wisata->durasi_hari) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fasilitas</label>
                    <input type="text" name="fasilitas" class="form-control" value="{{ old('fasilitas', $paket_wisata->fasilitas) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label><br>
                    @if($paket_wisata->foto)
                        <img src="{{ asset('storage/'.$paket_wisata->foto) }}" width="120" class="mb-2 rounded-3">
                    @endif
                    <input type="file" name="foto" class="form-control">
                </div>

                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Update</button>
                <a href="{{ route('paket-wisata.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
