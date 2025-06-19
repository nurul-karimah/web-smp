<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->string('usia');
            $table->string('jenis_kelamin');
            $table->string('foto');
            $table->unsignedBigInteger('orangtua_id');
            $table->timestamps();
            $table->foreign('orantua_id')->references('id')->on('orantua')->onDelete('casde');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};

// Nama lengkap
// Tanggal lahir
// Usia
// Jenis kelamin
// Foto anak