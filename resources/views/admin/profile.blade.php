@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h4 class="mb-4 fw-bold">Edit Profile</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                           class="form-control @error('email') is-invalid @enderror">
                    @error('email') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password (opsional)</label>
                    <input type="password" name="password" 
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
