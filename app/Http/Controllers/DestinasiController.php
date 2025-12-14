<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    // ================= ADMIN CRUD =================
    public function index()
    {
        $destinasi = Destinasi::paginate(10);
        return view('destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        return view('destinasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'harga_tiket' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('destinasi', 'public');
        }

        Destinasi::create($validated);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function edit(Destinasi $destinasi)
    {
        return view('destinasi.edit', compact('destinasi'));
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($destinasi->foto) {
                Storage::disk('public')->delete($destinasi->foto);
            }
            $validated['foto'] = $request->file('foto')->store('destinasi', 'public');
        }

        $destinasi->update($validated);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil diperbarui!');
    }

    public function destroy(Destinasi $destinasi)
    {
        if ($destinasi->foto) {
            Storage::disk('public')->delete($destinasi->foto);
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil dihapus!');
    }

    // ================= USER VIEW =================
    public function userIndex()
    {
        $destinasi = Destinasi::paginate(9);
        return view('user.destinasi', compact('destinasi'));
    }

    public function show($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        $destinasi->increment('views');

        $related = Destinasi::where('id', '!=', $destinasi->id)->inRandomOrder()->take(3)->get();

        return view('user.destinasi-show', compact('destinasi', 'related'));
    }
}
