<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        Kendaraan::factory()->createMany([
            ['cabang_id' => 1, 'jenis_kendaraan' => 'mobil', 'plat_nomor' => 'D2993FFW', 'merk' => 'Honda', 'nama_kendaraan' => 'Brio', 'tahun_pembuatan' => '2020', 'warna' => 'Hitam', 'harga_sewa' => 250000, 'status' => 'tersedia'],
            ['cabang_id' => 1, 'jenis_kendaraan' => 'mobil', 'plat_nomor' => 'D3928SF', 'merk' => 'Toyota', 'nama_kendaraan' => 'Rush', 'tahun_pembuatan' => '2022', 'warna' => 'Putih', 'harga_sewa' => 350000, 'status' => 'tersedia'],
            ['cabang_id' => 1, 'jenis_kendaraan' => 'mobil', 'plat_nomor' => 'F3948TRX', 'merk' => 'Honda', 'nama_kendaraan' => 'Mobilio', 'tahun_pembuatan' => '2018', 'warna' => 'Abu', 'harga_sewa' => 300000, 'status' => 'tersedia'],
            ['cabang_id' => 2, 'jenis_kendaraan' => 'mobil', 'plat_nomor' => 'B2837TDR', 'merk' => 'Honda', 'nama_kendaraan' => 'Jazz', 'tahun_pembuatan' => '2018', 'warna' => 'Merah', 'harga_sewa' => 250000, 'status' => 'tersedia'],
            ['cabang_id' => 2, 'jenis_kendaraan' => 'mobil', 'plat_nomor' => 'E9938DFF', 'merk' => 'Toyota', 'nama_kendaraan' => 'Yaris', 'tahun_pembuatan' => '2022', 'warna' => 'Abu', 'harga_sewa' => 280000, 'status' => 'tersedia'],
            ['cabang_id' => 2, 'jenis_kendaraan' => 'motor', 'plat_nomor' => 'D3838RYT', 'merk' => 'Yamaha', 'nama_kendaraan' => 'NMax', 'tahun_pembuatan' => '2020', 'warna' => 'Hitam', 'harga_sewa' => 150000, 'status' => 'tersedia'],
        ]);
    }
}
