<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('no_plat', 15)->unique();
            $table->enum('jenis_kendaraan', ['Matic', 'Manual Transmisi']);
            $table->string('no_stnk', 50);
            $table->unsignedSmallInteger('tahun_pembuatan');
            $table->string('nama_pemilik');
            $table->string('warna', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};