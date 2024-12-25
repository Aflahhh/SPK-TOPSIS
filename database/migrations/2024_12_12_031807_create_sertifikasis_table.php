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
        Schema::create('sertifikasis', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('pegawai_id');
            // $table->foreign('pegawai_id')->references('id')->on('pegawai');

            
            $table->integer('nip');
            $table->string('nama_pegawai');
            $table->string('jabatan');
            $table->string('nama_sertifikasi');
            $table->string('tgl_sertifikasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikasis');
    }
};
