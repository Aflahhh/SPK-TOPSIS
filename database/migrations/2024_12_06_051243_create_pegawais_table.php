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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->integer('nip')->unique();
            $table->string('nama_pegawai');
            $table->integer('nuptk')->unique()->nullable();        
            $table->string('jk');
            $table->string('tlahir');
            $table->date('ttl');            
            $table->bigInteger('prov_id');            
            $table->bigInteger('kab_id');            
            $table->bigInteger('kec_id');            
            $table->bigInteger('desa_id');            
            $table->string('alamat');            
            $table->string('email');
            $table->string('no_hp');
            $table->string('status_perkawinan');
            $table->integer('jabatan_id');
            $table->integer('golongan_id');
            $table->integer('mapel_id');
            $table->date('tgl_masuk')->nullable();
            $table->date('tgl_keluar')->nullable();
            $table->string('foto');

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
