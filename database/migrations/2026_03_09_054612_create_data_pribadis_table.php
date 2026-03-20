<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('data_pribadi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->string('no_hp');
            $table->string('email_pribadi');
            $table->text('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kode_pos', 10);
            $table->string('asal_sekolah');
            $table->year('tahun_lulus');
            $table->string('nama_ortu');
            $table->string('pekerjaan_ortu');
            $table->string('no_hp_ortu');
            $table->foreignId('program_studi_id')->constrained('program_studis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_pribadi');
    }
};