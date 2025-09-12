@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <h3 class="mb-4">Dashboard</h3>

  {{-- Statistik Card --}}
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-people fs-1 text-primary"></i>
          <h5 class="mt-2">Users</h5>
          <h3 class="fw-bold">120</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-map fs-1 text-success"></i>
          <h5 class="mt-2">Destinasi</h5>
          <h3 class="fw-bold">45</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-bar-chart fs-1 text-warning"></i>
          <h5 class="mt-2">Kunjungan</h5>
          <h3 class="fw-bold">3,250</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-cash-stack fs-1 text-danger"></i>
          <h5 class="mt-2">Pendapatan</h5>
          <h3 class="fw-bold">Rp 75jt</h3>
        </div>
      </div>
    </div>
  </div>

  {{-- Placeholder Chart --}}
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h5 class="card-title">Statistik Pengunjung Bulanan</h5>
      <div class="text-center text-muted py-5">
        <i class="bi bi-graph-up-arrow fs-1"></i>
        <p class="mt-2">[ Chart Placeholder ]</p>
      </div>
    </div>
  </div>
@endsection
