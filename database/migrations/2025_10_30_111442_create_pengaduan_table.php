<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('pengaduan_id');
            $table->string('nomor_tiket', 50)->unique();
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->unsignedBigInteger('kategori_id');
            $table->string('judul', 255);
            $table->text('deskripsi');
            $table->string('lokasi_text', 255);
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('bukti_foto')->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('tanggapan')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')
                ->references('kategori_id')
                ->on('kategori_pengaduan')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
};
