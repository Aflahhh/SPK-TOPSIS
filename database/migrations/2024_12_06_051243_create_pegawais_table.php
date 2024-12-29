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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('nuptk');
            $table->string('nama_pegawai', 255);
            $table->string('jk', 255);
            $table->integer('status_jabatan_id');
            $table->integer('nbm');
            $table->string('ttl', 255);
            $table->enum('pendidikan_terakhir', ['SMA', 'SMK', 'S1']);
            $table->string('jurusan', 255);
            $table->enum('status_karyawan', ['K', 'TK']);
            $table->date('tgl_masuk');
            $table->date('tgl_purna')->nullable();
            $table->string('sekolah_lain', 255)->nullable();
            $table->date('tahun_sertifikasi')->nullable();
            $table->string('tempat_sertifikasi', 255)->nullable();
            $table->string('no_hp', 255)->nullable();
            $table->string('alamat', 255);  
            $table->string('status_perkawinan', 255)->nullable();
            $table->integer('jabatan_id');
            $table->integer('golongan_id');
            $table->integer('mapel_id');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
