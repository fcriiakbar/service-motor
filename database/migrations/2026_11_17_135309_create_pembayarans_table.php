<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daftar_service_id')
                  ->constrained('daftar_services')->cascadeOnDelete();
            $table->unsignedBigInteger('jumlah_biaya');
            $table->enum('jenis_pembayaran', ['Cash / Tunai', 'Non Tunai']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};