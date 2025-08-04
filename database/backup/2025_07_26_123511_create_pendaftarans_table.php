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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('no_pendaftaran')->unique();
            $table->string('nisn')->nullable();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('penerima_kip', 10)->nullable();
            $table->string('alamat');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('sekolah_asal')->nullable();
            $table->string('dokumen_ijazah')->nullable();
            $table->string('dokumen_kk')->nullable();
            $table->string('dokumen_raport')->nullable();
            $table->decimal('nilai_raport_akhir', 5, 2)->nullable();
            $table->enum('status', ['menunggu persetujuan', 'diterima', 'ditolak'])->default('menunggu persetujuan');
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
