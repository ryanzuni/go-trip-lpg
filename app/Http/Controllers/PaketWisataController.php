<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use Illuminate\Http\Request;
use App\Models\Destinasi;

class PaketWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    // untuk user
    // untuk user
   public function userIndex()
{
    $paket = PaketWisata::with('destinasi')->paginate(9);
    return view('user.paket.index', compact('paket')); // ⬅️ ini cocok dengan index.blade.php
}

// untuk admin
public function index()
{
    $paket = PaketWisata::with('destinasi')->paginate(10);

    // view untuk ADMIN (sidebar)
    return view('admin.paket.index', compact('paket'));
}


    // public function index($id = null)
    // {
        
    //     // Ambil semua paket untuk ditampilkan di grid
    //     $paket = PaketWisata::with('destinasi')->paginate(9);

    //     // Ambil detail paket jika ada ID
    //     $detailPaket = $id ? PaketWisata::with('destinasi')->find($id) : null;

    //     return view('user.paket-wisata', compact('paket', 'detailPaket'));
    //     }
        //
        // $paket = PaketWisata::with('destinasi')->paginate(10);
        // return view('admin.paket.index', compact('paket'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $destinasi = Destinasi::all();
        return view('admin.paket.create', compact('destinasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_paket' => 'required',
            'destinasi_id' => 'required',
            'harga' => 'required|numeric',
            'durasi_hari' => 'required|numeric',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('paket', 'public');
        }

        PaketWisata::create($data);

        return redirect()->route('paket-wisata.index')->with('success','Paket wisata berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
 
    public function userShow($id)
    {
        // Ambil paket yang sedang dibuka
        $paket = PaketWisata::with('destinasi')->findOrFail($id);

        // Ambil paket lain (misal 6 paket terbaru selain paket ini)
        $paketLain = PaketWisata::with('destinasi')
                        ->where('id', '!=', $id)
                        ->latest()
                        ->take(6)
                        ->get();

        return view('user.paket.show', compact('paket', 'paketLain'));
        // $paket = PaketWisata::with('destinasi')->findOrFail($id);
        // return view('user.paket.show', compact('paket')); // ⬅️ pastikan file show.blade.php ada
    }

    public function show(PaketWisata $paketWisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaketWisata $paketWisata)
    {
        //
        $destinasi = Destinasi::all();
        return view('admin.paket.edit', compact('paket_wisata','destinasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaketWisata $paketWisata)
    {
        //
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('paket', 'public');
        }
        $paket_wisata->update($data);

        return redirect()->route('paket-wisata.index')->with('success','Paket wisata berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaketWisata $paketWisata)
    {
        //
        $paket_wisata->delete();
        return redirect()->route('paket-wisata.index')->with('success','Paket wisata berhasil dihapus');
    }
}
