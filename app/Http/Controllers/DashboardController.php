<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Transaksi;
use App\Models\PaketWisata;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPaket = PaketWisata::count();

        $jumlahDestinasi = Destinasi::count();

        $jumlahPengunjung = Transaksi::sum('jumlah_orang');

        $pendapatan = Transaksi::where('status', 'lunas')
            ->sum('total_harga');

        $jumlahBooking = Transaksi::count();

        // DATA PER BULAN (CHART)
        $chartData = Transaksi::select(
            DB::raw('MONTH(tanggal_berangkat) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        // FORMAT 12 BULAN
        $dataChart = [];

        for ($i = 1; $i <= 12; $i++) {
            $dataChart[] = $chartData[$i] ?? 0;
        }

        // EVENTS CALENDAR
        $events = Transaksi::with('paketWisata')
            ->get()
            ->map(function ($t) {

                return [
                    'title' => $t->nama_pelanggan,

                    'start' => Carbon::parse($t->tanggal_berangkat)
                        ->format('Y-m-d'),

                    'extendedProps' => [
                        'paket' => $t->paketWisata->nama_paket ?? '-',
                        'jumlah' => $t->jumlah_orang,
                        'total' => $t->total_harga,
                        'status' => $t->status,
                        'tanggal' => $t->tanggal_berangkat,
                    ]
                ];
            });

        // PAKET TERBARU
        $paketTerbaru = PaketWisata::with('destinasi')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'jumlahPaket',
            'jumlahDestinasi',
            'jumlahPengunjung',
            'pendapatan',
            'jumlahBooking',
            'dataChart',
            'paketTerbaru',
            'events'
        ));
    }
}
