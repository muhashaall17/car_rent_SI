<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashIn extends Model
{
    use HasFactory;
    protected $table = 'cash_in';
    protected $fillable = [
        'tgl_cin',
        'nominal',
        'deskripsi',
        'payment_id',
        'cabang_id',
    ];
}
