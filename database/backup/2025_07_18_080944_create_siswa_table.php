<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id(); // Kolom id (bigint, unsigned, auto_increment)
            $table->string('nis'); // Kolom nis (varchar)
            $table->string('nama'); // Kolom nama (varchar)
            $table->date('tgl_lahir'); // Kolom tgl_lahir (date)
            $table->string('usia'); // Kolom usia (varchar)
            $table->string('jenis_kelamin'); // Kolom jenis_kelamin (varchar)
            $table->string('foto')->nullable(); // Kolom foto (nullable varchar)
            $table->unsignedBigInteger('orangtua_id'); // Kolom orangtua_id (relasi)
            $table->timestamps(); // Kolom created_at & updated_at

            // Foreign key ke tabel orangtua
            $table->foreign('orangtua_id')->references('id')->on('orangtua')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
