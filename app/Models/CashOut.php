<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashOut extends Model
{
    use HasFactory;
    protected $table = 'cash_out';
    protected $fillable = [
        'nominal',
        'deskripsi',
        'tgl_cout',
        'cabang_id'
    ];
}
