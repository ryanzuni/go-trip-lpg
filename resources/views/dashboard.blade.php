@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="p-6 space-y-6">

    <!-- ===== HEADER ===== -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500">Selamat datang kembali</p>
    </div>

    <!-- ===== STATS ===== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- TOTAL PAKET -->
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-700 text-white p-7 rounded-3xl shadow-xl">

        <div class="absolute -right-6 -top-6 w-28 h-28 bg-white/10 rounded-full"></div>

        <div class="relative flex justify-between items-center">

            <div>
                <p class="text-sm opacity-80 mb-2">
                    Total Paket
                </p>

                <h2 class="text-4xl font-bold">
                    {{ $jumlahPaket }}
                </h2>

                <p class="text-xs opacity-70 mt-2">
                    Paket wisata tersedia
                </p>
            </div>

            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur">
                <i class="fas fa-suitcase text-3xl"></i>
            </div>

        </div>
    </div>


    <!-- TOTAL DESTINASI -->
    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-400 to-emerald-600 text-white p-7 rounded-3xl shadow-xl">

        <div class="absolute -right-6 -top-6 w-28 h-28 bg-white/10 rounded-full"></div>

        <div class="relative flex justify-between items-center">

            <div>
                <p class="text-sm opacity-80 mb-2">
                    Total Destinasi
                </p>

                <h2 class="text-4xl font-bold">
                    {{ $jumlahDestinasi }}
                </h2>

                <p class="text-xs opacity-70 mt-2">
                    Destinasi wisata aktif
                </p>
            </div>

            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur">
                <i class="fas fa-map-marker-alt text-3xl"></i>
            </div>

        </div>
    </div>


    <!-- TOTAL BOOKING -->
    <div class="relative overflow-hidden bg-gradient-to-br from-orange-400 to-orange-500 text-white p-7 rounded-3xl shadow-xl">

        <div class="absolute -right-6 -top-6 w-28 h-28 bg-white/10 rounded-full"></div>

        <div class="relative flex justify-between items-center">

            <div>
                <p class="text-sm opacity-80 mb-2">
                    Total Booking
                </p>

                <h2 class="text-4xl font-bold">
                    {{ $jumlahBooking }}
                </h2>

                <p class="text-xs opacity-70 mt-2">
                    Booking pelanggan
                </p>
            </div>

            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur">
                <i class="fas fa-users text-3xl"></i>
            </div>

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

        <div class="bg-white rounded-3xl shadow-xl p-6 border border-gray-100">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        Paket Terbaru
                    </h3>
                    <p class="text-sm text-gray-500">
                        Daftar paket wisata terbaru
                    </p>
                </div>

                <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-suitcase text-blue-600"></i>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="border-b text-gray-500">
                            <th class="text-left py-4">Paket</th>
                            <th class="text-left">Destinasi</th>
                            <th class="text-left">Harga</th>
                            <th class="text-left">Durasi</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700">

                        @forelse($paketTerbaru as $p)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <!-- NAMA -->
                            <td class="py-4">
                                <div class="flex items-center gap-3">

                                    <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-map text-blue-600"></i>
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $p->nama_paket }}
                                        </p>

                                        <p class="text-xs text-gray-400">
                                            ID #{{ $p->id }}
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <!-- DESTINASI -->
                            <td>
                                <div class="flex flex-wrap gap-2">

                                    @forelse($p->destinasi ?? [] as $d)
                                    <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-full text-xs">
                                        {{ $d->nama }}
                                    </span>
                                    @empty
                                    <span class="text-gray-400 text-xs">
                                        Tidak ada destinasi
                                    </span>
                                    @endforelse

                                </div>
                            </td>

                            <!-- HARGA -->
                            <td>
                                <span class="font-semibold text-emerald-600">
                                    Rp {{ number_format($p->harga_weekday ?? 0,0,',','.') }}
                                </span>
                            </td>

                            <!-- DURASI -->
                            <td>
                                <span class="px-3 py-1 bg-gray-100 rounded-full text-xs">
                                    {{ $p->durasi_hari ?? 0 }} Hari
                                </span>
                            </td>

                            <!-- STATUS -->
                            <td>

                                @php
                                $status = $p->status ?? 'aktif';
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $status == 'aktif'
                                ? 'bg-green-100 text-green-600'
                                : 'bg-yellow-100 text-yellow-600' }}">

                                    {{ ucfirst($status) }}

                                </span>

                            </td>

                        </tr>
                        @empty

                        <tr>
                            <td colspan="5" class="py-10 text-center text-gray-400">
                                Belum ada paket wisata
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>
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
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
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