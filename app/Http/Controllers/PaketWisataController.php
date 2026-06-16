<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use Illuminate\Http\Request;
use App\Models\Destinasi;

class PaketWisataController extends Controller
{
    /**
     * ================================
     * USER VIEW
     * ================================
     */

    public function userIndex()
    {
        $paket = PaketWisata::with('destinasi')->latest()->paginate(9);

        return view('user.paket_wisata.index', compact('paket'));
    }

    // public function userShow($id)
    // {
    //     $paket = PaketWisata::with('destinasi')->findOrFail($id);

    //     $paketLain = PaketWisata::with('destinasi')
    //         ->where('id', '!=', $id)
    //         ->latest()
    //         ->take(6)
    //         ->get();

    //     return view('user.paket_wisata.show', compact('paket', 'paketLain'));
    // }

    public function userShow($id)
    {
        $paket = PaketWisata::with([
            'destinasi',
            'privatePrices'
        ])->findOrFail($id);

        $paketLain = PaketWisata::with('destinasi')
            ->where('id', '!=', $id)
            ->latest()
            ->take(6)
            ->get();

        return view('user.paket_wisata.show', compact('paket', 'paketLain'));
    }

    /**
     * ================================
     * ADMIN VIEW
     * ================================
     */

    // public function index()
    // {
    //     $paket = PaketWisata::with('destinasi')->latest()->paginate(10);

    //     return view('admin.paket_wisata.index', compact('paket'));
    // }

    public function index()
    {
        $paket = PaketWisata::with([
            'destinasi',
            'privatePrices'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'admin.paket_wisata.index',
            compact('paket')
        );
    }

    public function create()
    {
        $destinasi = Destinasi::all();

        return view('admin.paket_wisata.create', compact('destinasi'));
    }

    /**
     * ================================
     * STORE
     * ================================
     */

    public function store(Request $request)
    {
        // $request->validate([
        //     'nama_paket'    => 'required|string|max:255',
        //     'destinasi_id'  => 'required|array|min:1',
        //     'destinasi_id.*' => 'exists:destinasis,id',
        //     'harga_weekday' => 'required|numeric',
        //     'harga_weekend' => 'required|numeric',
        //     'durasi_hari'   => 'required|numeric',
        //     'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        // ], [
        //     'foto.max'   => 'Ukuran foto maksimal 5MB',
        //     'foto.image' => 'File harus berupa gambar',
        // ]);
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'jenis_layanan' => 'required|in:open_trip,private_trip',
            'destinasi_id' => 'required|array|min:1',
            'destinasi_id.*' => 'exists:destinasis,id',
            'durasi_hari' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = $request->except('destinasi_id');

        if ($request->jenis_layanan == 'private_trip') {

            $data['harga_weekday'] = 0;
            $data['harga_weekend'] = 0;
        }

        // upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('paket', 'public');
        }

        // create paket
        $paket = PaketWisata::create($data);

        if (
            $request->jenis_layanan === 'private_trip'
            && $request->has('private')
        ) {

            foreach ($request->private['min'] as $index => $min) {

                if (
                    empty($min)
                    || empty($request->private['max'][$index])
                    || empty($request->private['weekday'][$index])
                    || empty($request->private['weekend'][$index])
                ) {
                    continue;
                }

                $paket->privatePrices()->create([
                    'min_peserta' => $min,
                    'max_peserta' => $request->private['max'][$index],
                    'harga_weekday' => $request->private['weekday'][$index],
                    'harga_weekend' => $request->private['weekend'][$index],
                ]);
            }
        }

        // simpan ke pivot (MULTIPLE DESTINASI)
        $paket->destinasi()->attach($request->destinasi_id);

        return redirect()
            ->route('admin.paket_wisata.index')
            ->with('success', 'Paket wisata berhasil ditambahkan');
    }

    /**
     * ================================
     * EDIT
     * ================================
     */

    public function edit(PaketWisata $paket_wisatum)
    {
        $destinasi = Destinasi::all();

        return view('admin.paket_wisata.edit', compact('paket_wisatum', 'destinasi'));
    }

    /**
     * ================================
     * UPDATE
     * ================================
     */

    public function update(Request $request, PaketWisata $paket_wisatum)
    {
        $request->validate([
            'nama_paket'    => 'required|string|max:255',
            'destinasi_id'  => 'required|array|min:1',
            'destinasi_id.*' => 'exists:destinasis,id',
            'harga_weekday' => 'required|numeric',
            'harga_weekend' => 'required|numeric',
            'durasi_hari'   => 'required|numeric',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'foto.max'   => 'Ukuran foto maksimal 5MB',
            'foto.image' => 'File harus berupa gambar',
        ]);

        $data = $request->except('destinasi_id');

        // upload foto baru
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('paket', 'public');
        }

        // update paket
        $paket_wisatum->update($data);

        // sync destinasi (replace semua)
        $paket_wisatum->destinasi()->sync($request->destinasi_id);

        return redirect()
            ->route('admin.paket_wisata.index')
            ->with('success', 'Paket wisata berhasil diperbarui');
    }

    /**
     * ================================
     * DELETE
     * ================================
     */

    public function destroy(PaketWisata $paket_wisatum)
    {
        // hapus relas                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    i pivot dulu
        $paket_wisatum->destinasi()->detach();

        // hapus paket
        $paket_wisatum->delete();

        return redirect()
            ->route('admin.paket_wisata.index')
            ->with('success', 'Paket wisata berhasil dihapus');
    }
}
