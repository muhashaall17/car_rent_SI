<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $table = 'rental';
    protected $fillable = [
        'no_invoice',    
        'tanggal_invoice', 
        'cabang_id', 
        'nama_pelanggan',   
        'alamat',
        'sim',
        'ktp',
        'kk',
        'email',
        'nomor_hp',
        'ktm',   
        'grand_total',
    ];

    // public function mobil()
    // {
    //     return $this->belongsTo(Mobil::class, 'id_mobil', 'id_mobil');
    // }
}
