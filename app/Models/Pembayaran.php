<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jumlah',
        'metode_pembayaran',
        'nama_pengirim',
        'tanggal_transfer',
        'bukti_transfer',
        'catatan',
        'status',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal_transfer' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}