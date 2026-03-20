<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('program_studi_id')->nullable()->change();
            // Hapus dulu foreign key yang bermasalah
            $table->dropForeign(['program_studi_id']);
            // Tambah lagi dengan benar
            $table->foreignId('program_studi_id')->constrained('program_studis')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['program_studi_id']);
        });
    }
};