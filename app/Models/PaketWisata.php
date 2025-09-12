<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaketWisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'destinasi_id',
        'deskripsi',
        'harga',
        'durasi_hari',
        'fasilitas',
        'foto',
        'itinerary', // tambahkan ini kalau ada kolom itinerary
    ];

    // Relasi ke tabel destinasi
    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id');
    }

// Relasi ke bookings (pemesanan)
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'paket_id');
    }

    // Relasi ke transaksi (kalau dipakai Midtrans nanti)
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'paket_id');
    }
}
