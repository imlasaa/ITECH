<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    public function run()
    {
        DB::table('program_studis')->insert([
            [
                'kode_prodi' => 'TI',
                'nama_prodi' => 'Teknik Informatika',
                'deskripsi' => 'Program studi yang fokus pada pengembangan perangkat lunak, kecerdasan buatan, dan teknologi informasi terkini.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_prodi' => 'SI',
                'nama_prodi' => 'Sistem Informasi',
                'deskripsi' => 'Mempelajari analisis, perancangan, dan implementasi sistem informasi untuk mendukung proses bisnis.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_prodi' => 'KM',
                'nama_prodi' => 'Kesehatan Masyarakat',
                'deskripsi' => 'Program studi yang mempersiapkan tenaga profesional di bidang kesehatan masyarakat dan promosi kesehatan.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}