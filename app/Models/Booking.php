<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Booking extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'paket_id',
        'nama',
        'email',
        'telepon',
        'jumlah_orang',
        'tanggal_booking',
        'harga_satuan',
        'total_harga',
        'catatan',
        'status',
        'snap_token',
    ];

    public function paketWisata()
    {
        return $this->belongsTo(PaketWisata::class, 'paket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function paket()
    // {
    //     return $this->belongsTo(PaketWisata::class, 'paket_id');
    // }
}
