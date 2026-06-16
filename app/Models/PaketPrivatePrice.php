<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketPrivatePrice extends Model
{
    protected $fillable = [
        'paket_wisata_id',
        'min_peserta',
        'max_peserta',
        'harga_weekday',
        'harga_weekend',
    ];

    public function paketWisata()
    {
        return $this->belongsTo(PaketWisata::class);
    }
}