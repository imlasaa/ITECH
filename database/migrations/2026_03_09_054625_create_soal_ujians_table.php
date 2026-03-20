<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('soal_ujian', function (Blueprint $table) {
            $table->id();
            $table->text('soal');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->string('opsi_e');
            $table->enum('kunci_jawaban', ['a', 'b', 'c', 'd', 'e']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soal_ujian');
    }
};