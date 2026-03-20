<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaAktif extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_aktif';

    protected $fillable = [
        'user_id',
        'nim',
        'program_studi_id',
        'tahun_masuk',
        'pas_foto',
    ];

    protected $casts = [
        'tahun_masuk' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }
}