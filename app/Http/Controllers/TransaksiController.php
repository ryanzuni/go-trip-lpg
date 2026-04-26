<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\PaketWisata;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
          $transaksis = Transaksi::with('paketWisata')->paginate(10); // <-- paginate 10 data per halaman
            return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $paketwisata = PaketWisata::all();
        return view('admin.transaksi.create', compact('paketwisata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'nama_pelanggan' => 'required',
            'paket_id' => 'required',
            'jumlah_orang' => 'required|integer|min:1',
            'tanggal_berangkat' => 'required|date',
            'total_harga' => 'required|numeric',
        ]);

        Transaksi::create($request->all());

        return redirect()->route('admin.transaksi.index')->with('success','Transaksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $paket = PaketWisata::all();
        return view('admin.transaksi.edit', compact('transaksi','paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        // 
        $request->validate([
            'nama_pelanggan' => 'required',
            'paket_id' => 'required',
            'jumlah_orang' => 'required|integer|min:1',
            'tanggal_berangkat' => 'required|date',
            'total_harga' => 'required|numeric',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('admin.transaksi.index')->with('success','Transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
        $transaksi->delete();
        return redirect()->route('admin.transaksi.index')->with('success','Transaksi berhasil dihapus');
    }
}
