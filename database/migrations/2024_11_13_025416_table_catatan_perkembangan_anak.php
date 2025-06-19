<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catatan_perkembangan_anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('dataakademik_id')->constrained('date_akademik_paud')->onDelete('cascade');
            $table->foreignId('absensi_id')->constrained('absensi')->onDelete('cascade');
            $table->integer('kehadiran')->default(0);
            $table->text('catatan_khusus')->nullable();
            $table->text('tanggapan_orang_tua')->nullable();
            $table->date('tanggal_pencatatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_perkembangan_anak');
    }
};
