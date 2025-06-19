<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('semester');
            $table->date('tanggal');
            $table->enum('status', ['Hadir', 'Izin', 'Alfa', 'Sakit'])->default('Alfa');
            $table->string('keterangan')->nullable();
            $table->string('gambar')->nullable();


            $table->timestamps();
        });

        DB::statement('ALTER TABLE absensi ADD lokasi POINT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
