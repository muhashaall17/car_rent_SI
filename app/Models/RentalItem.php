<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalItem extends Model
{
    use HasFactory;
    protected $table = 'rental_item';
    protected $fillable = [
        'rental_id',
        'kendaraan_id',
        'driver_id',
        'subtotal',
        'book_date_start',
        'book_date_end',
    ];
}
