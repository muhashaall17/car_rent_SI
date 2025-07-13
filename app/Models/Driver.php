<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'driver';
    protected $fillable = [
        'cabang_id',
        'nama_driver',
        'harga',
    ];

    public function cabang() {
        return $this->belongsTo(Cabang::class, 'id');
    }
}
