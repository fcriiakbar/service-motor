<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daftar_services', function (Blueprint $table) {
            $table->id();                          // Id servis pelanggan
            $table->string('no_plat', 15);
            $table->foreign('no_plat')
                  ->references('no_plat')->on('kendaraans')
                  ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('pelanggan_id')
                  ->constrained('pelanggans')->cascadeOnDelete();
            $table->text('keluhan');
            $table->date('tanggal_servis');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_services');
    }
};