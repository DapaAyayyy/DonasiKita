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
    Schema::create('kampanye_sosial', function (Blueprint $table) {
        // Gunakan id_kampanye sebagai primary key sesuai model
        $table->id('id_kampanye'); 
        
        // Custom foreign key id_penerima
        $table->foreignId('id_penerima')->constrained('penerima', 'id_penerima')->cascadeOnDelete();
        
        // Kolom lainnya (sesuaikan dengan kebutuhan Increment 1)
        $table->string('judul_kampanye');
        $table->text('deskripsi');
        $table->decimal('target_donasi', 15, 2); 
        $table->decimal('terkumpul', 15, 2)->default(0); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kampanye_sosial');
    }
};
