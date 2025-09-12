<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketWisata;
use App\Models\Destinasi;

class HomeController extends Controller
{
    public function index()
    {
        //  // ambil destinasi populer
        // $destinasi = Destinasi::take(8)->get();

        // // ambil paket wisata populer
        // $paketWisata = PaketWisata::with('destinasi')->take(6)->get();

        // return view('user.home', compact('destinasi', 'paketWisata'));
        // Ambil semua paket wisata beserta relasi destinasi
        // $paketWisata = PaketWisata::with('destinasi')->get();

        // // Ambil semua destinasi (opsional)
        // $destinasi = Destinasi::all();

        // return view('user.home', compact('paketWisata', 'destinasi'));
        // Ambil destinasi dengan views terbanyak, misal top 6
        // $destinasi = Destinasi::orderBy('views', 'desc')->take(6)->get();

        // return view('user.home', compact('destinasi'));
        $paketWisata = PaketWisata::with('destinasi')->get();
        $destinasi = Destinasi::latest()->paginate(6);
        // $destinasi = Destinasi::all();

        return view('user.home', compact('paketWisata', 'destinasi'));
    }
}
