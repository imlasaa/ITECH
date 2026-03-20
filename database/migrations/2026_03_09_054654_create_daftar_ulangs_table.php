<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('daftar_ulang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('surat_pernyataan')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('surat_keterangan_sehat')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->enum('status_berkas', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan_berkas')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daftar_ulang');
    }
};