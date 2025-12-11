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
        Schema::create('penilaian_layanan', function (Blueprint $table) {
            $table->id('penilaian_id'); // Primary Key
            $table->foreignId('pengaduan_id') // Foreign Key ke pengaduan
                  ->constrained('pengaduan', 'pengaduan_id')
                  ->onDelete('cascade');
            $table->tinyInteger('rating') // 1-5 bintang
                  ->unsigned()
                  ->check('rating >= 1 AND rating <= 5');
            $table->text('komentar')->nullable();
            $table->timestamps();

            // Satu pengaduan hanya bisa dinilai sekali
            $table->unique('pengaduan_id');

            // Index untuk performa query
            $table->index('pengaduan_id');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_layanan');
    }
};
