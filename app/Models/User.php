<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'program_studi_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }

    public function nomorTes()
    {
        return $this->hasOne(NomorTes::class);
    }

    public function dataPribadi()
    {
        return $this->hasOne(DataPribadi::class);
    }

    public function hasilUjian()
    {
        return $this->hasOne(HasilUjian::class);
    }

    public function jawabanUjian()
    {
        return $this->hasMany(JawabanUjian::class);
    }

    public function daftarUlang()
    {
        return $this->hasOne(DaftarUlang::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function mahasiswaAktif()
    {
        return $this->hasOne(MahasiswaAktif::class);
    }
}