<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'deskripsi',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function dataPribadi()
    {
        return $this->hasMany(DataPribadi::class);
    }

    public function mahasiswaAktif()
    {
        return $this->hasMany(MahasiswaAktif::class);
    }
}