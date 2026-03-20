<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jawaban_ujian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('soal_ujian_id')->constrained('soal_ujian')->onDelete('cascade');
            $table->enum('jawaban', ['a', 'b', 'c', 'd', 'e'])->nullable();
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
            
            $table->unique(['user_id', 'soal_ujian_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('jawaban_ujian');
    }
};