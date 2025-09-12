<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // Jumlah Destinasi
        $jumlahDestinasi = Destinasi::count();

        // Jumlah Pengunjung (jumlah total orang dari transaksi)
        $jumlahPengunjung = Transaksi::sum('jumlah_orang');

        // Pendapatan (hanya yang status Lunas)
        $pendapatan = Transaksi::where('status','lunas')->sum('total_harga');

        // Statistik: persentase transaksi lunas dari total transaksi
        $totalTransaksi = Transaksi::count();
        $lunas = Transaksi::where('status','lunas')->count();
        $persentaseLunas = $totalTransaksi > 0 ? round(($lunas / $totalTransaksi) * 100) : 0;

        return view('dashboard', compact(
            'jumlahDestinasi',
            'jumlahPengunjung',
            'pendapatan',
            'persentaseLunas'
        ));
    }
}
