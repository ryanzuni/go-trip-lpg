@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container">
    <!-- ================= Card Statistik ================= -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 p-3 text-center" style="background: linear-gradient(135deg, #4dabf7, #1971c2); color: #fff;">
                <i class="bi bi-box-seam fs-2 mb-2"></i>
                <h6>Total Paket Wisata</h6>
                <h3 class="fw-bold">12</h3>
                <small>Tooltip: Total paket tersedia</small>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 p-3 text-center" style="background: linear-gradient(135deg, #63e6be, #20c997); color: #fff;">
                <i class="bi bi-geo-alt fs-2 mb-2"></i>
                <h6>Total Destinasi</h6>
                <h3 class="fw-bold">5</h3>
                <small>Tooltip: Semua destinasi aktif</small>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 p-3 text-center" style="background: linear-gradient(135deg, #ffa94d, #fd7e14); color: #fff;">
                <i class="bi bi-people fs-2 mb-2"></i>
                <h6>Total Booking</h6>
                <h3 class="fw-bold">20</h3>
                <small>Tooltip: Booking bulan ini</small>
            </div>
        </div>
    </div>

    <!-- ================= Grafik + Kalender ================= -->
    <div class="row mb-4">
        <!-- Grafik Booking -->
        <div class="col-md-8 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">Statistik Booking Bulanan</div>
                <div class="card-body">
                    <canvas id="bookingChart" height="160"></canvas>
                    <small class="text-muted">Bar = Jumlah booking per bulan, Line = Trend harian</small>
                </div>
            </div>
        </div>

        <!-- Kalender Booking -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                    <span>Kalender Booking</span>
                    <span class="badge bg-primary" style="font-size: 0.8rem;">Booking Bulan Ini: 12</span>
                </div>
                <div class="card-body p-2">
                    <div id="calendar"></div>
                    <!-- Legend Event -->
                    <div class="mt-2">
                        <span class="badge rounded-pill" style="background-color:#0d6efd;">Bali</span>
                        <span class="badge rounded-pill" style="background-color:#198754;">Lombok</span>
                        <span class="badge rounded-pill" style="background-color:#fd7e14;">Bandung</span>
                        <span class="badge rounded-pill" style="background-color:#dc3545;">Jakarta</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= Tabel Paket Wisata ================= -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white fw-bold">Paket Wisata Terbaru</div>
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Nama Paket</th>
                        <th>Destinasi</th>
                        <th>Harga</th>
                        <th>Durasi (Hari)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Explore Bali <span class="badge bg-success">New</span></td>
                        <td>Bali</td>
                        <td>Rp 2.500.000</td>
                        <td>3</td>
                        <td><span class="badge bg-primary">Tersedia</span></td>
                    </tr>
                    <tr>
                        <td>Tour Lombok <span class="badge bg-success">New</span></td>
                        <td>Lombok</td>
                        <td>Rp 1.800.000</td>
                        <td>2</td>
                        <td><span class="badge bg-warning text-dark">Penuh</span></td>
                    </tr>
                    <tr>
                        <td>Bandung City Tour</td>
                        <td>Bandung</td>
                        <td>Rp 900.000</td>
                        <td>1</td>
                        <td><span class="badge bg-primary">Tersedia</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==== Script ==== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<style>
    /* Kalender Styling */
    #calendar {
        min-height: 360px;
        background: #fdfdfd;
        border-radius: 12px;
        padding: 8px;
        box-shadow: inset 0 0 6px rgba(0,0,0,0.05);
        font-size: 14px;
    }

    .fc .fc-toolbar-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .fc .fc-daygrid-day-number {
        font-weight: 500;
        color: #555;
    }

    .fc-event {
        border-radius: 20px !important;
        padding: 2px 6px !important;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .fc-event:hover {
        opacity: 0.85;
        transform: scale(1.05);
    }

    .fc-day-sat, .fc-day-sun {
        background-color: #f9fafc;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // ===== Grafik Booking =====
    const ctx = document.getElementById('bookingChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [
                {
                    label: 'Jumlah Booking',
                    data: [10, 20, 15, 30, 25, 40, 35, 28, 18, 22, 30, 45],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Trend Harian',
                    type: 'line',
                    data: [2,3,4,5,6,7,6,5,4,6,5,7],
                    borderColor: '#ff6384',
                    backgroundColor: 'rgba(255,99,132,0.2)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // ===== Kalender Booking =====
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: '100%',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        events: [
            { title: 'Explore Bali (10 pax)', start: '2025-09-05', end: '2025-09-07', color: '#0d6efd' },
            { title: 'Tour Lombok (6 pax)', start: '2025-09-12', end: '2025-09-13', color: '#198754' },
            { title: 'Bandung City Tour (4 pax)', start: '2025-09-20', color: '#fd7e14' },
            { title: 'Jakarta Heritage (8 pax)', start: '2025-09-25', end: '2025-09-27', color: '#dc3545' }
        ],
        dateClick: function(info) {
            document.getElementById("modalDate").innerText = "Tanggal: " + info.dateStr;
            var myModal = new bootstrap.Modal(document.getElementById('dateModal'));
            myModal.show();
        },
        eventClick: function(info) {
            document.getElementById("modalDate").innerText = 
                "Event: " + info.event.title + " (" + info.event.startStr + ")";
            var myModal = new bootstrap.Modal(document.getElementById('dateModal'));
            myModal.show();
        }
    });
    calendar.render();
});
</script>

<!-- Modal Info Kalender -->
<div class="modal fade" id="dateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3">
      <div class="modal-header">
        <h5 class="modal-title">Informasi Kalender</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p id="modalDate" class="fw-semibold text-primary"></p>
      </div>
    </div>
  </div>
</div>
@endsection
