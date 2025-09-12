<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataMaster extends Model
{
    //
    protected $fillable = ['nama', 'email', 'telepon', 'alamat'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'data_master_id');
    }
}
