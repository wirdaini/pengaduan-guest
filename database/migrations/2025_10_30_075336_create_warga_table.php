<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            // 1. PRIMARY & FOREIGN KEYS
            $table->id('warga_id');
            $table->unsignedBigInteger('user_id')->nullable();

            // 2. UNIQUE IDENTIFIERS
            $table->string('no_ktp', 16)->unique();
            $table->string('email');

            // 3. PERSONAL DATA
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);

            // 4. ADDITIONAL DATA
            $table->string('agama');
            $table->string('pekerjaan');
            $table->string('telp', 15);

            // 5. TIMESTAMPS
            $table->timestamps();

            // CONSTRAINTS
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('warga');
    }
};
