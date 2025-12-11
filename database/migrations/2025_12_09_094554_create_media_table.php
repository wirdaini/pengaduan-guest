<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('media', function (Blueprint $table) {
    //         $table->id('media_id');               // PK
    //         $table->string('ref_table', 50);      // 'pengaduan', 'tindak_lanjut'
    //         $table->unsignedBigInteger('ref_id'); // ID dari tabel referensi
    //         $table->string('file_name');          // file_url diubah jadi file_name
    //         $table->text('caption')->nullable();
    //         $table->string('mime_type'); // 'image/jpeg', 'application/pdf'
    //         $table->integer('sort_order')->default(0);
    //         $table->timestamps();

    //         // Index untuk pencarian cepat (TANPA FOREIGN KEY)
    //         $table->index(['ref_table', 'ref_id']);
    //     });
    // }

    // Tambah di migration media (jika belum ada)
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');               // PK
            $table->string('ref_table');          // 'tindak_lanjut', 'pengaduan'
            $table->unsignedBigInteger('ref_id'); // tindak_id, pengaduan_id
            $table->string('file_name');          // file_url diubah jadi file_name
            $table->text('caption')->nullable();
            $table->string('mime_type'); // 'image/jpeg', 'application/pdf'
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['ref_table', 'ref_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
