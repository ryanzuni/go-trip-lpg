<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'paket_id',
        'nama',
        'email',
        'telepon',
        'jumlah_orang',
        'catatan',
    ];

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class, 'paket_id');
    }
}
