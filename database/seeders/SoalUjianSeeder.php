<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoalUjian;

class SoalUjianSeeder extends Seeder
{
    public function run()
    {
        $soals = [
            [
                'soal' => 'Apa kepanjangan dari HTML?',
                'opsi_a' => 'Hyper Text Markup Language',
                'opsi_b' => 'High Text Markup Language',
                'opsi_c' => 'Hyper Tabular Markup Language',
                'opsi_d' => 'Home Tool Markup Language',
                'opsi_e' => 'Hyperlinks and Text Markup Language',
                'kunci_jawaban' => 'a'
            ],
            [
                'soal' => 'Manakah yang termasuk bahasa pemrograman?',
                'opsi_a' => 'HTML',
                'opsi_b' => 'CSS',
                'opsi_c' => 'JavaScript',
                'opsi_d' => 'XML',
                'opsi_e' => 'JSON',
                'kunci_jawaban' => 'c'
            ],
            [
                'soal' => 'Apa fungsi dari CSS?',
                'opsi_a' => 'Membuat struktur halaman web',
                'opsi_b' => 'Menambah interaktivitas',
                'opsi_c' => 'Mengatur tampilan halaman web',
                'opsi_d' => 'Menyimpan data',
                'opsi_e' => 'Menghubungkan ke database',
                'kunci_jawaban' => 'c'
            ],
            [
                'soal' => 'Laravel adalah framework berbasis...',
                'opsi_a' => 'Python',
                'opsi_b' => 'PHP',
                'opsi_c' => 'Java',
                'opsi_d' => 'Ruby',
                'opsi_e' => 'JavaScript',
                'kunci_jawaban' => 'b'
            ],
            [
                'soal' => 'Database management system yang sering digunakan dengan Laravel adalah...',
                'opsi_a' => 'MySQL',
                'opsi_b' => 'MongoDB',
                'opsi_c' => 'PostgreSQL',
                'opsi_d' => 'SQLite',
                'opsi_e' => 'Semua benar',
                'kunci_jawaban' => 'e'
            ],
        ];

        foreach ($soals as $soal) {
            SoalUjian::create($soal);
        }
    }
}