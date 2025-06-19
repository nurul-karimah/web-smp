<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAkademikPaudTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('date_akademik_paud', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('guru_id');
            $table->text('perkembangan_fisik')->nullable();
            $table->text('perkembangan_kognitif')->nullable();
            $table->text('perkembangan_sosial_emosional')->nullable();
            $table->text('perkembangan_bahasa')->nullable();
            $table->text('kegiatan_belajar');
            $table->string('semester');
            $table->string('tahun_ajaran');
            $table->string('nilai_fisik');
            $table->string('nilai_kognitif');
            $table->string('nilai_sosial');
            $table->string('nilai_bahasa');
            $table->string('nilai_belajar');
            $table->timestamps();

            //foregain key contrainst
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('date_akademik_paud');
    }
};
