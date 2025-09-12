@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="card shadow border-0">
    <div class="card-body">
        <h3 class="fw-bold">Selamat Datang, {{ auth()->user()->name }}</h3>
        <p class="text-muted">Anda berhasil login ke aplikasi wisata 🎉</p>
        <a href="#" class="btn btn-success">Lihat Destinasi Wisata</a>
    </div>
</div>
@endsection
