<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kendaraan extends Model
{
    protected $fillable = [
        'no_plat', 'jenis_kendaraan', 'no_stnk',
        'tahun_pembuatan', 'nama_pemilik', 'warna',
    ];

    public function daftarServices(): HasMany
    {
        return $this->hasMany(DaftarService::class, 'no_plat', 'no_plat');
    }
}