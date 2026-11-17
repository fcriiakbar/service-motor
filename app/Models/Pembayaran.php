<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $fillable = [
        'daftar_service_id', 'jumlah_biaya',
        'jenis_pembayaran', 'keterangan',
    ];

    public function daftarService(): BelongsTo
    {
        return $this->belongsTo(DaftarService::class);
    }
}