<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $fillable = [
        'nik',    
        'nama_pelanggan',
        'email',
        'no_hp',
        'alamat', 
    ];

    // public function mobil()
    // {
    //     return $this->belongsTo(Mobil::class, 'id_mobil', 'id_mobil');
    // }
}
