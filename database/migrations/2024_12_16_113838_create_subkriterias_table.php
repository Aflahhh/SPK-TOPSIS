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
        Schema::create('subkriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')
            ->constrained()
            ->onDelete('cascade');
            $table->string('kode_kriteria')->nullable(); 
            $table->string('nama_subkriteria'); 
            $table->decimal('bobot', 5, 2); 
            $table->timestamps();          


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subkriterias');
    }
};
