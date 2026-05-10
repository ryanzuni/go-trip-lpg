<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use App\Models\Destinasi;

class PaketWisata extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'destinasi' => 'array',
    // ];

    protected $fillable = [
        'nama_paket',
        // 'destinasi_id',
        'deskripsi',
        'harga',
        'harga_weekday',
        'harga_weekend',
        'durasi_hari',
        'fasilitas',
        'foto',
        'itinerary',
    ];

    // Relasi ke tabel destinasi
    // public function destinasi()
    // {
    //     return $this->belongsTo(Destinasi::class, 'destinasi_id');
    // }

    public function destinasi()
    {
        return $this->belongsToMany(
            Destinasi::class,
            'paket_destinasi',
            'paket_wisata_id',
            'destinasi_id'
        );
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

    /**
     * Accessor: Harga otomatis berdasarkan hari ini
     * Senin-Jumat => harga_weekday
     * Sabtu-Minggu => harga_weekend
     */
    public function getHargaHariIniAttribute()
    {
        $day = Carbon::now()->dayOfWeek; // 0 = Minggu, 6 = Sabtu

        return in_array($day, [0, 6])
            ? $this->harga_weekend
            : $this->harga_weekday;
    }
}
