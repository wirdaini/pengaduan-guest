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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('pengaduan_id');
            $table->string('nomor_tiket')->unique();
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori_pengaduan')->onDelete('cascade');
            $table->string('judul', 200);
            $table->text('deskripsi');
            $table->enum('status', ['Diterima', 'Diproses', 'Selesai', 'Ditolak'])->default('Diterima');
            $table->string('lokasi_text')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
