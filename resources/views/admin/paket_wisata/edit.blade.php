@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">✏️ Edit Paket Wisata</h5>

            <form action="{{ route('admin.paket_wisata.update', $paketWisata->id) }}" method="POST">
            @csrf
            @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control" 
                           value="{{ old('nama_paket', $paketWisata->nama_paket) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Destinasi</label>
                    <select name="destinasi_id" class="form-select" required>
                        @foreach($destinasi as $d)
                            <option value="{{ $d->id }}" 
                                {{ old('destinasi_id', $paketWisata->destinasi_id) == $d->id ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $paketWisata->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" 
                           value="{{ old('harga', $paketWisata->harga) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Durasi (Hari)</label>
                    <input type="number" name="durasi_hari" class="form-control" 
                           value="{{ old('durasi_hari', $paketWisata->durasi_hari) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fasilitas</label>
                    <input type="text" name="fasilitas" class="form-control" 
                           value="{{ old('fasilitas', $paketWisata->fasilitas) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label><br>
                    @if($paketWisata->foto)
                        <img src="{{ asset('storage/'.$paketWisata->foto) }}" width="120" class="mb-2 rounded-3">
                    @endif
                    <input type="file" name="foto" class="form-control">
                </div>

                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Update</button>
                <a href="{{ route('admin.paket_wisata.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
