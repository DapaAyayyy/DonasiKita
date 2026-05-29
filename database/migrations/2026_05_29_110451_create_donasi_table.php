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
        Schema::create('donasi', function (Blueprint $table) {
            $table->id('id_donasi'); 
            
            // Relasi ke kampanye_sosial menggunakan custom key id_kampanye
            $table->foreignId('id_kampanye')->constrained('kampanye_sosial', 'id_kampanye')->cascadeOnDelete();
            
            $table->string('nama_donatur')->default('Hamba Allah');
            
            // WAJIB DIPAKAI untuk Increment 1
            $table->decimal('nominal', 15, 2); 
            $table->string('status_donasi')->default('pending'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};
