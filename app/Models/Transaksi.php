<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    //
    use HasFactory;

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'nama_pelanggan',
        'email',
        'telepon',
        'paket_id',
        'jumlah_orang',
        'tanggal_berangkat',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paketwisata()
    {
        return $this->belongsTo(PaketWisata::class, 'paket_id');
        // return $this->belongsTo(Destinasi::class, 'paket_id');
    }

    public function dataMaster()
    {
        return $this->belongsTo(DataMaster::class, 'data_master_id');
    }
    
}

