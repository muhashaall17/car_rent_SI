<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $fillable = [
        'rental_id',
        'tgl_bayar',
        'metode_pembayaran',
        'nominal',
        'bukti_pembayaran'
    ];
}
