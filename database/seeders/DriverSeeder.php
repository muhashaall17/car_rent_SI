<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        Driver::factory()->createMany([
            ['cabang_id' => 1, 'nama_driver' => 'Asep', 'harga' => 200000],
            ['cabang_id' => 2, 'nama_driver' => 'Isep', 'harga' => 200000],
            ['cabang_id' => 2, 'nama_driver' => 'Yusuf', 'harga' => 200000],
            ['cabang_id' => 1, 'nama_driver' => 'Ahmad', 'harga' => 250000],
            ['cabang_id' => 1, 'nama_driver' => 'Dandi', 'harga' => 200000]
        ]);
    }
}