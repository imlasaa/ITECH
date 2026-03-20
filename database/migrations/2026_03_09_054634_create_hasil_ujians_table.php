<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hasil_ujian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('total_soal');
            $table->integer('jawaban_benar');
            $table->integer('jawaban_salah');
            $table->decimal('nilai', 5, 2);
            $table->enum('status', ['lulus', 'tidak_lulus', 'belum_dinilai'])->default('belum_dinilai');
            $table->datetime('waktu_mulai')->nullable();
            $table->datetime('waktu_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_ujian');
    }
};