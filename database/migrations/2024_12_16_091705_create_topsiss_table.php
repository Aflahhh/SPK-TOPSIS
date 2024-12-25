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
        Schema::create('topsiss', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained()->onDelete('cascade'); // Mengaitkan dengan tabel pegawai
            $table->decimal('nilai_preferensi', 10, 8); // Nilai preferensi hasil perhitungan TOPSIS
            $table->integer('peringkat'); // Peringkat pegawai berdasarkan nilai preferensi
            $table->timestamps();        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topses');
    }
};
