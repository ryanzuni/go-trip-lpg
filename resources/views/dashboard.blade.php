@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="p-6 space-y-6">

    <!-- ===== HEADER ===== -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500">Selamat datang kembali 👋</p>
    </div>

    <!-- ===== STATS ===== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Card 1 -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-80">Total Paket</p>
                    <h2 class="text-3xl font-bold">{{ $jumlahDestinasi }}</h2>
                </div>
                <i class="fas fa-box text-3xl opacity-80"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-gradient-to-r from-emerald-400 to-emerald-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-80">Total Destinasi</p>
                    <h2 class="text-3xl font-bold">{{ $jumlahDestinasi }}</h2>
                </div>
                <i class="fas fa-map-marker-alt text-3xl opacity-80"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-gradient-to-r from-orange-400 to-orange-500 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-80">Total Booking</p>
                    <h2 class="text-3xl font-bold">{{ $jumlahPengunjung }}</h2>
                </div>
                <i class="fas fa-users text-3xl opacity-80"></i>
            </div>
        </div>

    </div>

    <!-- ===== CHART + CALENDAR ===== -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Chart -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-gray-700 mb-4">Statistik Booking</h3>
            <canvas id="bookingChart" height="120"></canvas>
        </div>

        <!-- Calendar -->
        <div class="bg-white p-4 rounded-2xl shadow">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-gray-700">Kalender</h3>
                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                    {{ $jumlahBooking }} Booking
                </span>
            </div>
            <div id="calendar"></div>
        </div>

    </div>

    <!-- MODAL -->
    <div id="eventModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">

            <!-- CLOSE -->
            <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
                ✕
            </button>

            <h2 class="text-lg font-bold mb-4">Detail Booking</h2>

            <div class="space-y-2 text-sm text-gray-700">
                <p><strong>Nama:</strong> <span id="modalNama"></span></p>
                <p><strong>Paket:</strong> <span id="modalPaket"></span></p>
                <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
                <p><strong>Jumlah Orang:</strong> <span id="modalJumlah"></span></p>
                <p><strong>Total:</strong> <span id="modalTotal"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
            </div>

        </div>
    </div>

    <!-- ===== TABLE ===== -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="font-semibold text-gray-700 mb-4">Paket Terbaru</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-gray-500 border-b">
                    <tr>
                        <th class="py-3">Nama</th>
                        <th>Destinasi</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($paketTerbaru as $p)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 font-medium">{{ $p->nama_paket }}</td>
                        <td>{{ $p->destinasi->nama ?? '-' }}</td>
                        <td>Rp {{ number_format($p->harga,0,',','.') }}</td>
                        <td>{{ $p->durasi }} hari</td>
                        <td>
                            <span class="font-semibold {{ $p->status == 'tersedia' ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ==== Script ==== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    // Chart
    const ctx = document.getElementById('bookingChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Booking',
                data: @json($dataChart),
                borderWidth: 1
            }]
        }
    });

    // Calendar
    const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        height: 350,
        events: @json($events),

        eventClick: function(info) {
            const e = info.event;

            // isi modal
            document.getElementById('modalNama').innerText = e.title;
            document.getElementById('modalPaket').innerText = e.extendedProps.paket;
            document.getElementById('modalTanggal').innerText = e.extendedProps.tanggal;
            document.getElementById('modalJumlah').innerText = e.extendedProps.jumlah;
            document.getElementById('modalTotal').innerText = 'Rp ' + Number(e.extendedProps.total).toLocaleString('id-ID');
            document.getElementById('modalStatus').innerText = e.extendedProps.status;

            // tampilkan modal
            document.getElementById('eventModal').classList.remove('hidden');
            document.getElementById('eventModal').classList.add('flex');
        }
    });

    calendar.render();
});
function closeModal() {
    document.getElementById('eventModal').classList.add('hidden');
}
</script>
@endsection