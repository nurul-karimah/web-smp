<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel siswa (bukan user)
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');

            $table->decimal('jumlah_tagihan', 10, 2);
            $table->date('tanggal_tagihan')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['lunas', 'belum lunas'])->default('belum lunas');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
