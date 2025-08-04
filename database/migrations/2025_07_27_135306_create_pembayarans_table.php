<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bukti_pembayaran'); // path file
            $table->decimal('total_bayar', 10, 2);
            $table->string('digunakan_untuk')->default('PPDB');
            $table->timestamp('tanggal_bayar')->useCurrent();
            $table->enum('status', ['menunggu persetujuan', 'diterima', 'ditolak'])->default('menunggu persetujuan');
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
