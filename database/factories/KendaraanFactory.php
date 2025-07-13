<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class KendaraanFactory extends Factory
{
    protected $model = Kendaraan::class;

    public function definition()
    {
        return [
            'cabang_id' => $this->faker->unique,
            'jenis_kendaraan' => $this->faker->name,
            'plat_nomor' => $this->faker->name,
            'merk' => $this->faker->name,
            'nama_kendaraan' => $this->faker->name,
            'tahun_pembuatan' => $this->faker->numberBetween(1950, 2025),
            'warna' => $this->faker->name,
            'harga_sewa' => $this->faker->numberBetween(100000, 1000000),
            'gambar' => $this->faker->name,
            'status' => 'tersedia',
        ];
    }
}
