<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabang;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        Cabang::factory()->createMany([
            ['nama_cabang' => 'Bandung'],
            ['nama_cabang' => 'Purwakarta'],
        ]);
    }
}