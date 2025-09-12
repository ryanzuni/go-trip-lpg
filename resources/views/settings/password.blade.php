@extends('layouts.app')
@section('title','Ubah Password')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">🔒 Ubah Password</h5>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('settings/password') }}">
                @csrf
                <div class="mb-3">
                    <label>Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
