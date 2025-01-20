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
        Schema::create('request', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id_request');
            $table->integer('id_ruangan');
            $table->integer('id_dosen');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('status_request', ['diterima', 'ditolak']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
    }
};
