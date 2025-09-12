@extends('layouts.app')
@section('title','Profil Admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">🛠 Profil Admin</h5>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ url('settings/profile') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
