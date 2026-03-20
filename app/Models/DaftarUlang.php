<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarUlang extends Model
{
    use HasFactory;

    protected $table = 'daftar_ulang';

    protected $fillable = [
        'user_id',
        'surat_pernyataan',
        'pas_foto',
        'surat_keterangan_sehat',
        'kartu_keluarga',
        'status_berkas',
        'catatan_berkas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}