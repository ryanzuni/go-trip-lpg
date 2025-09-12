<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use PDF; // alias di config/app.php
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function transaksi(Request $request)
    {
    //     $query = Transaksi::with('paketWisata'); // ambil relasi paket wisata

    //     // Filter tanggal (optional)
    //     if($request->has('start') && $request->has('end')){
    //         $query->whereBetween('tanggal_berangkat', [$request->start, $request->end]);
    //     }

    //     // Filter status
    //     if($request->has('status') && $request->status != ''){
    //         $query->where('status', $request->status);
    //     }

    //     $transaksi = $query->orderBy('tanggal_berangkat','desc')->get();

    //     return view('laporan.transaksi', compact('transaksi'));
    // }
     $transaksi = Transaksi::with('paketWisata')
        ->orderBy('tanggal_berangkat','desc')
        ->get();

    // Nama admin dan tanggal laporan
    $dateNow = Carbon::now()->format('d M Y');
    $adminName = auth()->user()->name ?? 'Admin';

    // Cek export PDF
    if($request->has('export') && $request->export == 'pdf'){
        // Load Blade yang sama
        $pdf = PDF::loadView('laporan.transaksi', compact('transaksi','dateNow','adminName'));
        return $pdf->download('Transaksi.pdf'); // nama file rapi
    }

    return view('laporan.transaksi', compact('transaksi','dateNow','adminName'));
    }

    public function pendapatan(Request $request)
    {
        $query = Transaksi::with('paketWisata')->where('status','lunas');

        if($request->has('bulan') && $request->bulan != ''){
            $query->whereMonth('tanggal_berangkat', $request->bulan);
        }
        if($request->has('tahun') && $request->tahun != ''){
            $query->whereYear('tanggal_berangkat', $request->tahun);
        }
        if($request->has('paket') && $request->paket != ''){
            $query->where('paket_id', $request->paket);
        }

        $transaksi = $query->get();

        // Hitung total pendapatan per paket
        $pendapatanPaket = $transaksi->groupBy('paket_id')->map(function($item){
            return [
                'nama_paket' => $item->first()->paketWisata->nama ?? '-',
                'jumlah_transaksi' => $item->count(),
                'total_pendapatan' => $item->sum('total_harga'),
            ];
        });

        $isPdf = $request->has('export') && $request->export == 'pdf';
        $dateNow = \Carbon\Carbon::now()->format('d M Y');
        $adminName = auth()->user()->name ?? 'Admin';

        if($isPdf){
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.pendapatan', compact('pendapatanPaket','dateNow','adminName','isPdf'));
            return $pdf->download('Laporan_Pendapatan.pdf');
        }

        return view('laporan.pendapatan', compact('pendapatanPaket','isPdf'));
    }

    public function paketWisata(Request $request)
{
    $query = Transaksi::with('paketWisata')->where('status','lunas');

    $transaksi = $query->get();

    $paketRanking = $transaksi->groupBy('paket_id')->map(function($item){
        return [
            'nama_paket' => $item->first()->paketWisata->nama ?? '-',
            'jumlah_transaksi' => $item->count(),
        ];
    })->sortByDesc('jumlah_transaksi');

    $isPdf = $request->has('export') && $request->export == 'pdf';
    $dateNow = \Carbon\Carbon::now()->format('d M Y');
    $adminName = auth()->user()->name ?? 'Admin';

    if($isPdf){
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.paket_wisata', compact('paketRanking','dateNow','adminName','isPdf'));
        return $pdf->download('Laporan_Paket_Wisata.pdf');
    }

    return view('laporan.paket_wisata', compact('paketRanking','isPdf'));
}

}
