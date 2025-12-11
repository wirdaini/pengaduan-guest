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
        Schema::create('tindak_lanjut', function (Blueprint $table) {
            $table->id('tindak_id'); // Primary Key
            $table->foreignId('pengaduan_id') // Foreign Key ke pengaduan
                  ->constrained('pengaduan', 'pengaduan_id')
                  ->onDelete('cascade');
            $table->string('petugas', 100); // Nama petugas
            $table->text('aksi'); // Aksi yang dilakukan
            $table->text('catatan')->nullable(); // Catatan tambahan
            $table->timestamps(); // created_at & updated_at

            // Index untuk performa query
            $table->index('pengaduan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut');
    }
};
